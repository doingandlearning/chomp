<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = '';
$auth_token = '';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+441708394072";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
// Where to send a text message (your cell phone?)
    '+447739814877',
    array(
        'from' => $twilio_number,
        'body' => 'Sending this message from my computer while I get chomp set up - E is asleep x'
    )
);