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
use App\Laravel\Models\TaxCertificate;
use App\Laravel\Events\SendReference;
use App\Laravel\Events\SendTaxReference;
use App\Laravel\Events\SendViolationReference;
use App\Laravel\Events\SendApplication;

/* App Classes
 */
use Carbon,Auth,DB,Str,Helper,Event;

class OtherTransactionController extends Controller
{
    protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['cert_type'] = ['' => "Choose CTC type",'basic' =>  "Basic Community Tax",'salary' =>  "Income From Salary",'business' => "Sales From Business",'property' => "Income from real property taxes"];
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
		$this->data['violation_count'] = Violators::where('customer_id' , $id)->count();
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
					$new_other_transaction->status = "APPROVED";
					$new_other_transaction->contact_number = $request->get('contact_number');
					$new_other_transaction->application_name = "Ticket Violation";
					if ($request->get('violation_count') == 0) {
						$new_other_transaction->amount = 200;
					}elseif ($request->get('violation_count') == 1) {
						$new_other_transaction->amount = 300;
					}else{
						$new_other_transaction->amount = 600;
					}
					
					$new_other_transaction->processor_user_id = Auth::user()->id;
					$new_other_transaction->save();

					$new_other_transaction->code = 'EOTC-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->processing_fee_code = 'OT-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));

					$new_other_transaction->save();

					$new_violators = new Violators;
					$new_violators->transaction_id = $new_other_transaction->id;
					$new_violators->ticket_no = $request->get('ticket_no');
					$new_violators->customer_id = $request->get('customer_id');

					$new_violators->p_firstname = $request->get('p_firstname');
					$new_violators->p_middlename = $request->get('p_middlename');
					$new_violators->p_lastname = $request->get('p_lastname');
					
					$new_violators->place_of_violation = $request->get('place_of_violation');
					$new_violators->date_time = $request->get('date_time');
					$new_violators->violation = $request->get('violation');
					$new_violators->violation_name = $request->get('violation_name');
					$new_violators->save();
					$insert[] = [
		                'contact_number' => $new_other_transaction->contact_number,
		                'ref_num' => $new_other_transaction->processing_fee_code,
		                'amount' => $new_other_transaction->amount,
                		'full_name' => $new_other_transaction->customer->full_name,
                		'violation_name' => $new_violators->violation_name
		            ];	
					$notification_data = new SendViolationReference($insert);
				    Event::dispatch('send-sms-violation', $notification_data);

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
			case 'ctc':
				try{
					$new_other_transaction = new OtherTransaction;
					$new_other_transaction->customer_id = $request->get('customer_id');
					$new_other_transaction->type = 2;
					$new_other_transaction->email = $request->get('email');
					$new_other_transaction->contact_number = $request->get('contact_number');
					$new_other_transaction->amount = $request->get('total_amount');
					$new_other_transaction->application_name = "Community Tax Certificate";
					$new_other_transaction->processor_user_id = Auth::user()->id;
					$new_other_transaction->status = "APPROVED";
					$new_other_transaction->save();
					$new_other_transaction->code = 'EOTC-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));
					$new_other_transaction->processing_fee_code = 'OT-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($new_other_transaction->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3));
					$new_other_transaction->save();

					$new_tax_certificate = new TaxCertificate;
					$new_tax_certificate->transaction_id = $new_other_transaction->id;
					$new_tax_certificate->other_customer_id = $request->get('customer_id');
					$new_tax_certificate->tax_type = $request->get('ctc_type');
					$new_tax_certificate->additional_tax = $request->get('additional_tax');
					$new_tax_certificate->subtotal = $request->get('subtotal');
					$new_tax_certificate->interest = $request->get('interest');
					$new_tax_certificate->total_amount = $request->get('total_amount');
					switch ($request->get('ctc_type')) {
						case 'salary':
							$new_tax_certificate->income_salary = $request->get('income_salary');
						break;
						case 'business':
							$new_tax_certificate->business_sales = $request->get('business_sales');
						break;
						case 'property':
							$new_tax_certificate->income_real_state = $request->get('income_real_state');
						break;
						default:
						break;
					}
					$new_tax_certificate->save();
					
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
		$this->data['ctc'] = TaxCertificate::where('transaction_id',$id)->first();
		$this->data['violator'] = Violators::where('transaction_id',$id)->first();
		$this->data['page_title'] = "Transaction Details";
		return view('system.other-transaction.show',$this->data);
	}

	public function edit(PageRequest $request,$id = NULL){
		$this->data['type'] = $request->get('type');
		switch ($this->data['type']) {
			case 1:
				$value = "violation";
				$this->data['type'] = $value;
				break;
			case 2:
				$value = "ctc";
				$this->data['type'] = $value;
				break;
		}
		$this->data['transaction'] = $request->get('other_transaction_data');
		$this->data['ctc'] = TaxCertificate::where('transaction_id',$id)->first();
		$this->data['customer'] = OtherCustomer::find($this->data['ctc']->other_customer_id);

		$this->data['page_title'] = "Transaction Details";
		return view('system.other-transaction.edit-'.$value,$this->data);
	}

	public function update(OtherTransactionRequest $request , $id = NULL){
		$tax_certificate = TaxCertificate::where('transaction_id',$id)->first();
		$this->data['customer'] = OtherCustomer::find($tax_certificate->other_customer_id);
		switch ($request->get('transaction_type')) {
			case 'ctc':
				try{
					$transaction = $request->get('other_transaction_data');
					
					$transaction->email = $request->get('email');
					$transaction->contact_number = $request->get('contact_number');
					$transaction->amount = $request->get('total_amount');
					$transaction->save();

					$tax_certificate = TaxCertificate::where('transaction_id',$id)->first();
					$tax_certificate->tax_type = $request->get('ctc_type');
					$tax_certificate->additional_tax = $request->get('additional_tax');
					$tax_certificate->subtotal = $request->get('subtotal');
					$tax_certificate->interest = $request->get('interest');
					$tax_certificate->total_amount = $request->get('total_amount');
					switch ($request->get('ctc_type')) {
						case 'salary':
							$tax_certificate->income_salary = $request->get('income_salary');
						break;
						case 'business':
							$tax_certificate->business_sales = $request->get('business_sales');
						break;
						case 'property':
							$tax_certificate->income_real_state = $request->get('income_real_state');
						break;
						default:
						break;
					}
					$tax_certificate->save();
				
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
			
		}
	}
	
	public function process($id = NULL,PageRequest $request){
		DB::beginTransaction();

		try{
			$transaction = $request->get('other_transaction_data');
			$transaction->status = strtoupper($request->get('status_type'));
			$transaction->remarks = $request->get('remarks') ? $request->get('remarks') : "";
			$transaction->modified_at = Carbon::now();
			$transaction->save();
			
			// $insert[] = [
   //              'contact_number' => $transaction->contact_number,
   //              'ref_num' => $transaction->processing_fee_code,
   //              'amount' => $transaction->amount,
   //              'full_name' => $transaction->customer->full_name
   //          ];

			// $notification_data = new SendTaxReference($insert);
		 //    Event::dispatch('send-sms-tax', $notification_data);

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Transaction has been successfully Processed.");
			return redirect()->route('system.other_transaction.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}
}
