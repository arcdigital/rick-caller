<?php
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
  return view('home', ['phones' => App\Phone::all()]);
});

Route::get('phones/{id}/delete', function($id)
{
  $phone = App\Phone::find($id);
  if ($phone)
    {
    $phone->delete();
    echo 'Removed Successfully. <a href="/">Go Back</a>';
  }
  else
    {
    echo 'Invalid ID';
  }
    
});

Route::post('phones/create', function()
{
  try
    {
    $number = Input::get('number');
    if (strlen($number) != 12)
      {
      return 'Error. <a href="/">Go Back</a>';
    }
    $phone = App\Phone::create(['number' => $number]);
  if ($phone)
    {
          Bus::dispatch(new App\Commands\InitiateCall($phone));

    return 'Added Successfully. <a href="/">Go Back</a>';
  }
  else
    {
    return 'Error. <a href="/">Go Back</a>';
  }
  }
  catch (Exception $e)
    {
    return 'Error. <a href="/">Go Back</a>';
  }
  
    
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('initiate/{phone}', function(App\Phone $phone)
{
      Bus::dispatch(
        new App\Commands\InitiateCall($phone)
    );
/*
  $client = new Services_Twilio(Config::Get('twilio.sid'), Config::Get('twilio.token'));
  $call = $client->account->calls->create(Config::Get('twilio.numbers')[array_rand(Config::Get('twilio.numbers'))], $phone, "http://rick-caller-6298.nitrousapp.com:3000/flow/rickd", array());
  $sms = $client->account->messages->sendMessage(Config::Get('twilio.numbers')[array_rand(Config::Get('twilio.numbers'))], $phone, "LOL", "http://rick-caller-6298.nitrousapp.com:3000/resources/picture.gif");
  echo 'Call - '.$call->sid.' :: SMS - '.$sms->sid;*/
});

Route::match(['get', 'post'], 'flow/rickd', function()
          {
            $content =  "<Response><Play>http://rick-caller-6298.nitrousapp.com:3000/resources/song.mp3</Play></Response>";
            return (new Response($content, 200))->header('Content-Type', 'text/xml');
          });

Route::match(['get', 'post'], 'flow/voice', function()
          {
            $content =  "<Response><Say>ha ha.   lawl</Say><Play>http://rick-caller-6298.nitrousapp.com:3000/resources/song.mp3</Play></Response>";
            return (new Response($content, 200))->header('Content-Type', 'text/xml');
          });

Route::match(['get', 'post'], 'flow/messaging', function()
          {
            $content =  "<Response><Message>LOLz<Media>http://rick-caller-6298.nitrousapp.com:3000/resources/picture.gif</Media></Message></Response>";
            return (new Response($content, 200))->header('Content-Type', 'text/xml');
          });
