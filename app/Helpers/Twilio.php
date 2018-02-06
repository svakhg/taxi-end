<?php
namespace App\Helpers;

use Twilio\Rest\Client;

class Twilio
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendSms($phoneNumber, $message, $from)
    {
        try {
            $this->sendMessage($phoneNumber, $message, $from);
            return true;

        } 
        catch ( \Twilio\Exceptions\RestException  $e ) {
            return $e;
        }
    }

    private function sendMessage($phoneNumber, $message, $from)
    {
        $twilioPhoneNumber = config('services.twilio')['phoneNumber'];
        $messageParams = array(
            'from' => $from,
            'body' => $message
        );

        $this->client->messages->create(
            $phoneNumber,
            $messageParams
        );
    }
}
