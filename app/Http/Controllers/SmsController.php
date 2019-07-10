<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{

    public function sendSms($number, $message)
    {
        $accountSid = config(
            'app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config(
            'app.twilio')['TWILIO_AUTH_TOKEN'];
        $client =
            new Client($accountSid, $authToken);

        try
        {
            $client->messages->create(
                $number,
                array(
                    'from' => '+441708394072',
                    'body' => $message
                )
            );
        }

        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
}
