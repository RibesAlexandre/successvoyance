<?php

namespace App\Mail;

use App\Models\Telling\TellingEmailResponse;
use App\Models\Telling\TellingEmailSended;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseTelling extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $email;

    /**
     * @var
     */
    protected $response;

    /**
     * ResponseTelling constructor.
     * @param TellingEmailSended $email
     * @param TellingEmailResponse $response
     */
    public function __construct(TellingEmailSended $email, TellingEmailResponse $response)
    {
        $this->email = $email;
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->response->soothsayer->nickname . ' a répondu à votre email de voyance pour ' . config('app.name'))->markdown('emails.response_telling')->with([
            'email'     =>  $this->email,
            'response'  =>  $this->response,
        ]);
    }
}
