<?php
namespace App\Mail;

//  Models
use App\Models\Comment;
use App\Models\Soothsayer;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class AlertSoothsayerComment
 * @author Alexandre Ribes
 * @package App\Mail
 */
class AlertSoothsayerComment extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * @var
     */
    protected $comment;

    /**
     * @var
     */
    protected $soothsayer;

    /**
     * AlertSoothsayerComment constructor.
     * @param Soothsayer $soothsayer
     * @param Comment $comment
     * @param User $user
     */
    public function __construct(Soothsayer $soothsayer, Comment $comment, User $user)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->soothsayer = $soothsayer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau commentaire sur votre fiche voyance')->markdown('emails.alert_soothsayer_comment')->with([
            'user'          =>  $this->user,
            'comment'       =>  $this->comment,
            'soothsayer'    =>  $this->soothsayer,
        ]);
    }
}
