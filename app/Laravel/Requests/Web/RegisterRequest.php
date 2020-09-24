<?php namespace App\Laravel\Requests\Web;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class RegisterRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;
		$rules = [
			'fname' => "required",
			'lname' => "required",
			'region' => "required",
			'town' => "required",
			'brgy' => "required",
			'street_name' => "required",
			'unit_number' => "required",
			'zipcode' => "required",
			'birthdate' => "required|date_format:Y-m-d",
			'tin_no' => "nullable",
			'sss_no' => "nullable",
			'phic_no' => "nullable",
			'contact_number' => "required|max:10|phone:PH",
			'email'	=> "required|unique:customer,email,{$id}",
			'password'	=> "required|confirmed",
		];
		
		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'contact_number.phone' => "Please provide a valid PH mobile number.",
			'birthdate.date_format' => "Invalid Date Format."
		];
	}
}