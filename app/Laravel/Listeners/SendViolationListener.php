<?php 
namespace App\Laravel\Listeners;

use App\Laravel\Events\SendViolationReference;

class SendViolationListener{

	public function handle(SendViolationReference $contact_number){
		$contact_number->job();

	}
}