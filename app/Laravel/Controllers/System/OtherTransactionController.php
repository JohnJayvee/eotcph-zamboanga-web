<?php

namespace App\Laravel\Controllers\System;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\System\OtherTransactionRequest;
/*
 * Models
 */
use App\Laravel\Models\OtherTransaction;
use App\Laravel\Models\OtherApplication;
use App\Laravel\Models\Violations;
use App\Laravel\Models\Violators;
use App\Laravel\Models\OtherCustomer;

use App\Laravel\Events\SendReference;
use App\Laravel\Events\SendApplication;

/* App Classes
 */
use Carbon,Auth,DB,Str,Helper;

class OtherTransactionController extends Controller
{
    protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
		
		$this->data['types'] = ['' => "Choose Transaction"] + OtherApplication::pluck('name', 'id')->toArray();
		$this->data['violations'] = ['' => "Choose Violations"] + Violations::pluck('description', 'id')->toArray();
		$this->per_page = env("DEFAULT_PER_PAGE",10);
	}

	public function  index(PageRequest $request){
		$this->data['page_title'] = "Other Transaction";
		$this->data['other_transactions'] = OtherTransaction::orderBy('created_at',"DESC")->get(); 
		return view('system.other-transaction.index',$this->data);
	}

	public function  create(PageRequest $request , $id = NULL){
		$this->data['type'] = $request->get('type');
		$this->data['customer_id'] = $id;
		$this->data['customer'] = OtherCustomer::find($id);
		$this->data['violation_count'] = OtherTransaction::where('customer_id' , $id)->count();
		$this->data['page_title'] .= " - Add new record";
		return view('system.other-transaction.'.$request->get('type'),$this->data);
	}

	public function store(OtherTransactionRequest $request){
		switch ($request->get('type')) {
			case 'violation':
				DB::beginTransaction();
				try{
					$new_other_transaction = new OtherTransaction;
					$new_other_transaction->customer_id = $request->get('customer_id');
					$new_other_transaction->type = 1;
					$new_other_transaction->email = $request->get('email');
					$new_other_transaction->contact_number = $request->get('contact_number');
					$new_other_transaction->application_name = "Ticket Violation";
					if ($request->get('violation_count') == 0) {
						$new_other_transaction->processing_fee = 200;
					}elseif ($request->get('violation_count') == 1) {
						$new_other_transaction->processing_fee = 300;
					}else{
						$new_other_transaction->processing_fee = 600;
					}
					
					$new_other_transaction->processor_user_id = Auth::user()->id;
					$new_other_transaction->save();

					$new_other_transaction->code = 'EOTC-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->processing_fee_code = 'OT-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->transaction_code = 'APP-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));
					$new_other_transaction->save();

					$new_violators = new Violators;
					$new_violators->transaction_id = $new_other_transaction->id;
					$new_violators->ticket_no = $request->get('ticket_no');
					$new_violators->customer_id = $request->get('customer_id');
					
					$new_violators->p_middlename = $request->get('p_middlename');
					$new_violators->p_lastname = $request->get('p_lastname');
					
					$new_violators->place_of_violation = $request->get('place_of_violation');
					$new_violators->date_time = $request->get('date_time');
					$new_violators->violation = $request->get('violation');
					$new_violators->save();
					$insert[] = [
		                'contact_number' => $new_other_transaction->contact_number,
		                'ref_num' => $new_other_transaction->processing_fee_code
		            ];	
					$notification_data = new SendReference($insert);
				    Event::dispatch('send-sms', $notification_data);
					DB::commit();
					session()->flash('notification-status', "success");
					session()->flash('notification-msg', "Transaction has been added.");
					return redirect()->route('system.other_transaction.index');
				}catch(\Exception $e){
					DB::rollback();
					session()->flash('notification-status', "failed");
					session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
					return redirect()->back();

				}
				break;
			case 'ctc':
				try{
					$new_other_transaction = new OtherTransaction;
					$new_other_transaction->customer_id = $request->get('customer_id');
					$new_other_transaction->type = 2;
					$new_other_transaction->email = $request->get('email');
					$new_other_transaction->contact_number = $request->get('contact_number');
					$new_other_transaction->application_name = "Community Tax Certificate";
					$new_other_transaction->processing_fee = $request->get('cert_amount');
					$new_other_transaction->processor_user_id = Auth::user()->id;
					$new_other_transaction->save();

					$new_other_transaction->code = 'EOTC-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->processing_fee_code = 'OT-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->transaction_code = 'APP-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));
					$new_other_transaction->save();

					$new_violators = new Violators;
					$new_violators->transaction_id = $new_other_transaction->id;
					$new_violators->ticket_no = $request->get('ticket_no');
					$new_violators->customer_id = $request->get('customer_id');
					
					$new_violators->p_middlename = $request->get('p_middlename');
					$new_violators->p_lastname = $request->get('p_lastname');
					
					$new_violators->place_of_violation = $request->get('place_of_violation');
					$new_violators->date_time = $request->get('date_time');
					$new_violators->violation = $request->get('violation');
					$new_violators->save();
					$insert[] = [
		                'contact_number' => $new_other_transaction->contact_number,
		                'ref_num' => $new_other_transaction->processing_fee_code
		            ];	
					$notification_data = new SendReference($insert);
				    Event::dispatch('send-sms', $notification_data);
					DB::commit();
					session()->flash('notification-status', "success");
					session()->flash('notification-msg', "Transaction has been added.");
					return redirect()->route('system.other_customer.show',[$request->get('customer_id')]);
				}catch(\Exception $e){
					DB::rollback();
					session()->flash('notification-status', "failed");
					session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
					return redirect()->back();

				}
				break;
			default:
				# code...
				break;
		}
		
	}

	public function show(PageRequest $request,$id = NULL){
		$this->data['transaction'] = $request->get('other_transaction_data');
		$this->data['page_title'] = "Transaction Details";
		return view('system.other-transaction.show',$this->data);
	}
}
