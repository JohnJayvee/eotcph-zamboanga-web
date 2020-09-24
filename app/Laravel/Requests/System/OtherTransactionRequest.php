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
					'ctc_type' => "required",
					'interest' => "nullable|numeric",
						
				];
				switch ($this->get('ctc_type')) {
					case 'salary':
						$rules['income_salary'] = "required|numeric";
					break;
					case 'business':
						$rules['business_sales'] = "required|numeric";
					break;
					case 'property':
						$rules['income_real_state'] = "required|numeric";
					break;
				}
				break;
				
			default:
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