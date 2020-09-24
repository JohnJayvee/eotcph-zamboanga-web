<?php 
namespace App\Laravel\Listeners;

use App\Laravel\Events\SendTaxReference;

class SendTaxListener{

	public function handle(SendTaxReference $contact_number){
		$contact_number->job();

	}
}