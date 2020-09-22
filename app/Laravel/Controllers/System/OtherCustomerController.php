<?php

namespace App\Laravel\Controllers\System;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\System\OtherCustomerRequest;
/*
 * Models
 */
use App\Laravel\Models\OtherCustomer;
use App\Laravel\Models\OtherTransaction;



/* App Classes
 */
use Carbon,Auth,DB,Str,Helper;

class OtherCustomerController extends Controller
{
     protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['genders'] = ['' => "Choose Gender",'male' =>  "Male",'female' => "Female"];
		$this->data['civil_status'] = ['' => "Choose Type",'single' =>  "Single",'married' => "Married",'seperated' => "Seperated",'widow' => "Widow"];

		$this->per_page = env("DEFAULT_PER_PAGE",10);
	}
	public function  index(PageRequest $request){
		$this->data['page_title'] = "Local Customer";
		$this->data['other_customers'] = OtherCustomer::orderBy('created_at',"DESC")->get(); 
		return view('system.other-customer.index',$this->data);
	}

	public function  create(PageRequest $request){
		$this->data['page_title'] .= " - Add new record";
		return view('system.other-customer.create',$this->data);
	}


	public function store(OtherCustomerRequest $request){
		DB::beginTransaction();
		try{
			$new_other_customer = new OtherCustomer;
			$new_other_customer->firstname = $request->get('firstname');
			$new_other_customer->lastname = $request->get('lastname');
			$new_other_customer->middlename = $request->get('middlename');
			$new_other_customer->address = $request->get('address');
			$new_other_customer->tin_no = $request->get('tin_no');
			$new_other_customer->citizenship = $request->get('citizenship');
			$new_other_customer->gender = $request->get('gender');
			$new_other_customer->birthday = $request->get('birthday');
			$new_other_customer->status = $request->get('status');
			$new_other_customer->place_of_birth = $request->get('place_of_birth');
			$new_other_customer->height = $request->get('height');
			$new_other_customer->weight = $request->get('weight');
			$new_other_customer->occupation = $request->get('occupation');
			$new_other_customer->contact_number = $request->get('contact_number');
			$new_other_customer->email = $request->get('email');
			$new_other_customer->save();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "New Local Customer has been added.");
			return redirect()->route('system.other_customer.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	public function  show(PageRequest $request,$id = NULL){
		$this->data['page_title'] .= " - Show record";
		$this->data['other_customer'] = $request->get('other_customer_data');
		$this->data['transactions'] = OtherTransaction::where('customer_id',$this->data['other_customer']->id)->get();
		
		return view('system.other-customer.show',$this->data);
	}


}
