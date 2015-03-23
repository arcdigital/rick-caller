<?php namespace App\Commands;

use App\Commands\Command;
use Illuminate\Support\Facades\Config as Config;
use Illuminate\Contracts\Bus\SelfHandling;

class InitiateCall extends Command implements SelfHandling {

  protected $phone;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(\App\Phone $phone)
	{
		$this->phone = $phone;
    
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		  $client = new \Services_Twilio(Config::Get('twilio.sid'), Config::Get('twilio.token'));
  $call = $client->account->calls->create(Config::Get('twilio.numbers')[array_rand(Config::Get('twilio.numbers'))], $this->phone->number, "http://rick-caller-6298.nitrousapp.com:3000/flow/rickd", array());
  $sms = $client->account->messages->sendMessage(Config::Get('twilio.numbers')[array_rand(Config::Get('twilio.numbers'))], $this->phone->number, "LOL", "http://rick-caller-6298.nitrousapp.com:3000/resources/picture.gif");

	}

}
