<?php
namespace App\Http\Controllers;

use App\Models\TellingEmail;
use Auth;
use Illuminate\Http\Request;

/**
 * Class TellingController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class TellingController extends Controller
{
    public function email()
    {
        $emails = TellingEmail::orderBy('amount', 'ASC')->get();
        return view('telling.email', compact('emails'));
    }
}
