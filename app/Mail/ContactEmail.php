<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ContactEmail
 * @author Alexandre Ribes
 * @package App\Mail
 */
class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * ContactEmail constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau message sur Success Voyance !')->replyTo($this->request->input('email'))->markdown('emails.contact')->with([
            'email'     =>  $this->request->input('email'),
            'name'      =>  $this->request->input('name') . ($this->request->has('firstname') ? ' ' . $this->request->input('firstname') : ''),
            'content'   =>  $this->request->input('content'),
            'topic'     =>  $this->request->input('topic')
        ]);
    }
}
