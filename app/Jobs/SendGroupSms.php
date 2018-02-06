<?php

namespace App\Jobs;

use App\Contact;
use App\GroupSms;
use App\GroupSmsStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Twilio\Rest\Client;

class SendGroupSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $groupSmsStatus;
    public $tries = 1;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GroupSmsStatus $groupSmsStatus)
    {
        $this->groupSmsStatus = $groupSmsStatus;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phoneNumber = "+960".$this->groupSmsStatus->phone_number;
        $message = $this->groupSmsStatus->groupsms->message;
        // $from = $this->groupSmsStatus->groupsms->senderId;
        $from = '+15005550006';

        $this->sendMessage($phoneNumber, $message, $from);
        $this->groupSmsStatus->satus = "Sms send successfully";
        $this->groupSmsStatus->delivered = "1";
    }

    public function failed(\Twilio\Exceptions\RestException $e)
    {
        $this->groupSmsStatus->status = $e->getMessage();
        $this->groupSmsStatus->delivered = "2";
        $this->groupSmsStatus->save();
    }

    private function sendMessage($phoneNumber, $message, $from)
    {
        $account_sid = env('TWILIO_ACCOUNT_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');

        $client = new Client($account_sid, $auth_token);

        $twilioPhoneNumber = config('services.twilio')['phoneNumber'];
        $messageParams = array(
            'from' => $from,
            'body' => $message
        );

        $client->messages->create(
            $phoneNumber,
            $messageParams
        );
    }
}
