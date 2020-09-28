<?php 

namespace App\Laravel\Controllers\System;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;

/*
 * Models
 */
use App\Laravel\Models\Transaction;
use App\Laravel\Models\TransactionRequirements;

/* App Classes
 */
use Carbon,Auth,DB,Str,ImageUploader;

class TransactionController extends Controller{

	protected $data;
	protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
		
		$this->per_page = env("DEFAULT_PER_PAGE",10);
	}

	public function  index(PageRequest $request){
		$this->data['page_title'] = "Transactions";
		$this->data['transactions'] = Transaction::orderBy('created_at',"DESC")->get(); 
		return view('system.transaction.index',$this->data);
	}
	public function show(PageRequest $request,$id = NULL){
		$this->data['count_file'] = TransactionRequirements::where('transaction_id',$id)->count();
		$this->data['attachments'] = TransactionRequirements::where('transaction_id',$id)->get();
		$this->data['transaction'] = $request->get('transaction_data');

		$this->data['page_title'] = "Transaction Details";
		return view('system.transaction.show',$this->data);
	}
	
	public function process($id = NULL,PageRequest $request){
		DB::beginTransaction();
		try{
			$transaction = $request->get('transaction_data');
			$transaction->status = strtoupper($request->get('status_type'));
			$transaction->remarks = $request->get('remarks') ? $request->get('remarks') : "";
			$transaction->save();

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Transaction has been successfully Processed.");
			return redirect()->route('system.transaction.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	public function process_requirements($id = NULL,$status = NULL,PageRequest $request){
		DB::beginTransaction();
		
		try{
			$transaction = TransactionRequirements::find($id);
			$transaction->status = $request->get('status');
			$transaction->save();

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Requirements has been successfully ".$request->get('status').".");
			return redirect()->route('system.transaction.show',[$transaction->transaction_id]);
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	public function  destroy(PageRequest $request,$id = NULL){
		$transaction = $request->get('transaction_data');
		DB::beginTransaction();
		try{
			$transaction->delete();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Transaction removed successfully.");
			return redirect()->route('system.barangay.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	
}