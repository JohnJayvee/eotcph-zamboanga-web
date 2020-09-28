<?php namespace App\Laravel\Requests\Web;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class CTCRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;
		$rules = [
			'email' => "required",
			'contact_number' => "required",
			'tin_no' => "required|numeric",
			'citizenship' => "required",
			'gender' => "required",
			'birthdate' => "required",
			'status' => "required",
			'place_of_birth' => "required",
			'height' => "required|numeric",
			'weight' => "required|numeric",
			'occupation' => "required",
			'ctc_type' => "required",
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
			default:
			break;
		}
		
		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'weight.numeric' => "Please input a valid data.",
			'height.numeric' => "Please input a valid data.",

		];
	}
}