<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class OtherCustomerRequest extends RequestManager{

	public function rules(){

		$rules = [
			'firstname' => "required",
			'lastname' => "required",
			'middlename' => "required",
			'address' => "required",
			'tin_no' => "required",
			'citizenship' => "required",
			'gender' => "required",
			'birthday' => "required",
			'status' => "required",
			'place_of_birth' => "required",
			'height' => "required",
			'weight' => "required",
			'occupation' => "required",
			'contact_number' => "required",
			'email' => "required",
			
		];

		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
		];
	}
}