<?php

namespace App\Mail;

use App\Models\AstrologicalSign;
use App\Models\Horoscope;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class HoroscopeEmail
 * @author Alexandre Ribes
 * @package App\Mail
 */
class HoroscopeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $horoscope;

    /**
     * @var
     */
    protected $astrologicalSign;

    /**
     * HoroscopeEmail constructor.
     * @param User $user
     * @param Horoscope $horoscope
     * @param AstrologicalSign $astrologicalSign
     */
    public function __construct(User $user, Horoscope $horoscope, AstrologicalSign $astrologicalSign)
    {
        $this->user = $user;
        $this->horoscope = $horoscope;
        $this->astrologicalSign = $astrologicalSign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre horoscope sur Success Voyance !')->markdown('emails.horoscope')->with([
            'user'          =>  $this->user,
            'horoscope'     =>  $this->horoscope,
            'sign'          =>  $this->astrologicalSign,
        ]);
    }
}
