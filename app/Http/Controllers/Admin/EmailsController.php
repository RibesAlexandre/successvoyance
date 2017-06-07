<?php
namespace App\Http\Controllers\Admin;

//  Services
use App\Mail\ResponseTelling;
use Mail;
use App\Http\Controllers\Controller;

//  Models
use App\Models\Telling\TellingEmail;
use App\Models\Telling\TellingEmailSended;
use App\Models\Telling\TellingEmailResponse;

//  Requests
use App\Http\Requests\Admin\ResponseEmailRequest;
use App\Http\Requests\Admin\CreateEditEmailRequest;

/**
 * Class EmailsController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class EmailsController extends Controller
{
    /**
     * Liste des offres d'emails
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $emails = TellingEmail::orderBy('amount', 'ASC')->get();
        return view('admin.telling.emails_index', compact('emails'));
    }

    /**
     * Liste de toutes les conversations d'emails
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $emails = TellingEmailSended::latest()->groupBy('identifier')->get();
        return view('admin.telling.emails_all', compact('emails'));
    }

    /**
     * Affichage d'une conversation d'email
     *
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conversation($identifier)
    {
        $emails = TellingEmailSended::with('response')->where('identifier', $identifier)->oldest()->get();
        return view('admin.telling.emails_conversation', compact('emails'))->with('last', $emails[count($emails) - 1]);
    }

    /**
     * Réponse à un email
     *
     * @param ResponseEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(ResponseEmailRequest $request)
    {
        if( is_null($request->user()->soothsayer_id) ) {
            return response()->json([
                'success'   =>  false,
                'alert'     =>  true,
                'message'   =>  'Votre profil n\'est associé à aucun voyant, vous devez être associé un profil voyant pour répondre aux emails utilisateurs.'
            ]);
        }

        $email = TellingEmailSended::with('user')->where('id', $request->input('email_send_id'))->firstOrFail();
        $response = TellingEmailResponse::create([
            'email_send_id'     =>  $email->id,
            'soothsayer_id'     =>  $request->user()->soothsayer_id,
            'content'           =>  $request->input('content'),
            'identifier'        =>  $request->input('identifier'),
        ]);

        //  On avertit l'utilisateur de la réponse
        Mail::to($email->user->email)->send(new ResponseTelling($email, $response));

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre réponse à correctement été envoyé à l\'utilisateur !',
            'redirect'  =>  route('admin.emails.all'),
        ]);
    }

    /**
     * Création d'une offre de voyance
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $email = new TellingEmail();
        return view('admin.telling.emails_create', compact('email'));
    }

    /**
     * Enregistrement d'une nouvelle offre de voyance par email
     *
     * @param CreateEditEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEditEmailRequest $request)
    {
        $inputs = $request->all();
        $inputs['popular'] = $request->has('popular') ? true : false;
        $inputs['enabled'] = $request->has('enabled') ? true : false;

        TellingEmail::create($inputs);
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'L\'offre de voyance par email a correctement été créée !',
            'redirect'  =>  route('admin.emails.index')
        ]);
    }

    /**
     * Edition d'une offre de voyance
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $email = TellingEmail::findOrFail($id);
        return view('admin.telling.emails_edit', compact('email'));
    }

    /**
     * Mise à jour de l'offre de voyance par email
     *
     * @param $id
     * @param CreateEditEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, CreateEditEmailRequest $request)
    {
        $email = TellingEmail::findOrFail($id);
        $inputs['popular'] = $request->has('popular') ? true : false;
        $inputs['enabled'] = $request->has('enabled') ? true : false;

        $email->update($inputs);
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'L\'offre de voyance par email a correctement été mise à jour !',
            'redirect'  =>  route('admin.emails.index')
        ]);
    }

    /**
     * Suppression d'une offre d'email
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $email = TellingEmail::findOrFail($id);
        $email->delete();

        return response()->json([
            'success'   =>  true
        ]);
    }
}
