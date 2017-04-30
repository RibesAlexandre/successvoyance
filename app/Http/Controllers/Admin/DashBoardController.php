<?php
namespace App\Http\Controllers\Admin;

//  Models
use App\Models\Comment;
use App\Models\Horoscope;
use App\Models\Newsletter;
use App\Models\Payment;
use App\Models\Soothsayer;
use App\Models\User;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;

use DevDojo\Chatter\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DashBoardController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class DashBoardController extends Controller
{
    /**
     * Accueil du dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::select('id')->count();
        //$posts = Post::select('id')->count();
        $posts = \DevDojo\Chatter\Models\Post::select('id')->count();
        //$topics = Topic::select('id')->count();
        $topics = Discussion::select('id')->count();
        $soothsayers = Soothsayer::select('id')->count();
        $comments = Comment::select('id')->count();
        $payments = Payment::select('id')->count();
        $newsletter = Newsletter::select('id')->count();
        $horoscopes = Horoscope::select('id')->count();

        return view('admin.dashboard.index', compact('users', 'posts', 'topics', 'comments', 'soothsayers', 'payments', 'newsletter', 'horoscopes'));
    }
}