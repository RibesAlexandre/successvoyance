<?php
namespace App\Mail;

use App\Http\Requests\TellingEmailRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ContactTelling
 * @author Alexandre Ribes
 * @package App\Mail
 */
class ContactTelling extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $identifier;

    /**
     * ContactTelling constructor.
     * @param TellingEmailRequest $request
     * @param $identifier
     */
    public function __construct(TellingEmailRequest $request, $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouvel email de voyance sur Success Voyance !')->markdown('emails.contact_telling')->with([
            'user'          =>  $this->request->user(),
            'topic'         =>  $this->request->input('topic'),
            'identifier'    =>  $this->identifier,
            'content'       =>  $this->request->input('content'),
        ]);
    }
}
