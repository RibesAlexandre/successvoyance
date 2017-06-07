<?php
namespace App\Http\Controllers;

//  Utils
use Date;
use Auth;
use Illuminate\Http\Request;
use Mail;

//  Request
use App\Http\Requests\TellingEmailRequest;

//  Models
use App\Mail\ContactTelling;
use App\Models\Telling\TellingEmail;
use App\Models\Telling\TellingEmailUser;
use App\Models\Telling\TellingEmailSended;

/**
 * Class TellingController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class TellingController extends Controller
{
    /**
     * Formulaire de paiement ou d'envoi d'email
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email(Request $request)
    {
        if( Auth::check() ) {
            $total = Auth::user()->emails()->where('total', '>', 0)->first();
            if( $total && !$request->has('order') ) {
                return view('telling.email_send', compact('total'));
            }
        }

        session('back', back());
        $emails = TellingEmail::orderBy('amount', 'ASC')->enabled()->get();
        return view('telling.email', compact('emails'));
    }

    /**
     * Envoie de l'email de voyance
     *
     * @param TellingEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(TellingEmailRequest $request)
    {
        $lastEmail = TellingEmailUser::where('user_id', $request->user()->id)->latest()->first();
        if( $lastEmail->created_at >= Date::now()->subMinutes(15) ) {
            return response()->json([
                'success'   =>  false,
                'alert'     =>  true,
                'message'   =>  'Vous avez déjà contacté nos voyants il y a moins de 15 minutes. Veuillez attendre avant de renvoyer un email.',
            ]);
        }

        $total = Auth::user()->emails()->where('total', '>', 0)->first();
        if( !$total ) {
            return response()->json([
                'success'   =>  true,
                'alert'     =>  true,
                'message'   =>  'Vous avez atteint votre quota d\'emails, pour continuer à envoyer vous devez acheter un nouveau pack d\'emails'
            ]);
        }

        $identifier = str_random(10) . '-' . Date::now()->format('dmY');
        TellingEmailSended::create([
            'user_id'       =>  $request->user()->id,
            'topic'         =>  $request->input('topic'),
            'content'       =>  $request->input('content'),
            'identifier'    =>  $identifier,
        ]);
        Mail::to(config('successvoyance.contact'))->send(new ContactTelling($request, $identifier));
        TellingEmailUser::where('user_id', $request->user()->id)->decrement('total');

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre email a correctement été transmis à nos voyants ! Ils tâcheront de vous répondre le plus rapidement possible.'
        ]);
    }
}
