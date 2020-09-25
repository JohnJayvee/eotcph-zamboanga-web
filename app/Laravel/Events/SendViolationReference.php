<?php 
namespace App\Laravel\Events;

use Illuminate\Queue\SerializesModels;
use Mail,Str,Helper,Carbon,Nexmo;

class SendViolationReference extends Event {


	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(array $form_data)
	{
		$this->data = $form_data;
		// $this->email = $form_data['insert'];

	

	}

	public function job(){	
		
		
		foreach($this->data as $index =>$value){
			$phone = $value['contact_number'];
			$ref_num = $value['ref_num'];
			$amount = $value['amount'];
			$full_name = $value['full_name'];
			$violation_name = $value['violation_name'];

			$nexmo = Nexmo::message()->send([
				'to' => '+63'.(int)$phone,
				'from' => 'EOTCPH' ,
				'text' => "Hello ". $full_name .", good day! This is your payment reference number ".$ref_num." amounting PHP " .$amount. " for violating the ".$violation_name.".\r\n\n Please visit the http://18.138.0.249/ and input the payment reference number to the E-Payment section to pay. This payment reference number will expire on 11:59 PM. You can pay via online(Debit/Credit card, e-wallet, etc.) or over-the-counter (7Eleven, Bayad Center, Cebuana Lhuillier, and to other affiliated partners) \r\n\n Note: If you failed to pay before your payment reference number expires, you can get a new reference number at the http://18.138.0.249/ and will be charged with a penalty."
			]);
			
		}


		
		
		
	}
}
