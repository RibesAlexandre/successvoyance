<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Telling\TellingEmail;
use Illuminate\Http\Request;

/**
 * Class PaymentController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{
    public function process(Request $request)
    {
        if( $request->input('payment_type') == 'email' ) {
            $service = 'email';
            $offer = TellingEmail::where('id', $request->input('email_id'))->firstOrFail();
        }

        Payment::create([
            'user_id'               =>  $request->user()->id,
            'amount'                =>  $offer->amount,
            'payment_id'            =>  null,
            'card_expire_month'     =>  null,
            'card_expire_year'      =>  null,
            'service'               =>  $service,
        ]);

        if( $service == 'email' ) {
            $request->user()->emails()->create([
                'email_id'  =>  $offer->id,
                'total'     =>  $offer->quantity,
            ]);

            flash()->success('Votre paiement a bien été pris en compte, vous pouvez désormais prendre contact avec nos voyants !');

            if( session()->has('back') ) {
                return redirect(session('back'));
            }
            return redirect()->route('telling.email');
        }
    }
}
