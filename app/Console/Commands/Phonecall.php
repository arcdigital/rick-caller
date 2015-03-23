<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Phonecall extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'phonecall';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Initiate Phone Calls.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
    $phones = \App\Phone::all();
    foreach ($phones as $phone)
    {
      $fuckThem = rand(0,1);
      if ($fuckThem)
      {
        \Bus::dispatch(new \App\Commands\InitiateCall($phone));
      }
    }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
