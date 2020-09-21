<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class OtherTransactionRequest extends RequestManager{

	public function rules(){
		$type = $this->get('type');
		$rules = [];
		switch ($type) {
			case 'violation':
				$rules = [
					'ticket_no' => "required",
					'd_firstname' => "required",
					'd_middlename' => "required",
					'd_lastname' => "required",
					'p_firstname' => "required",
					'p_middlename' => "required",
					'p_lastname' => "required",
					'address' => "required",
					'violation' => "required",
					'place_of_violation' => "required",
					'date_time' => "required",
					'email' => "required",
					'contact_number' => "required|max:10|phone:PH",
				];
				break;
			case 'ctc':
				$rules = [
					'email' => "required",
					'contact_number' => "required|max:10|phone:PH",
					'income_salary' => "required|numeric|min:0",
					'income_salary_two' => "required|numeric|min:0",
					'business_sales' => "required|numeric|min:0",
					'business_sales_two' => "required|numeric|min:0",
					'income_real_state' => "required|numeric|min:0",
					'income_real_state_two' => "required|numeric|min:0",
					'subtotal' => "required|numeric|min:0",
					'interest' => "required|numeric|min:0",
					'total_tax_due' => "required|numeric|min:0",
					'cert_amount' => "required|numeric|min:0",
				];
				break;
				break;
			default:
				# code...
				break;
		}
		
		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'numeric' => "Please input a valid amount.",
			'min' => "Minimum amount is 0.",
		];
	}
}