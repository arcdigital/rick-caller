<?php

return [

	'sid' => env('TWILIO_SID'),
	'token' => env('TWILIO_TOKEN'),
	'numbers' => explode(',', env('TWILIO_NUMBERS')),

];
