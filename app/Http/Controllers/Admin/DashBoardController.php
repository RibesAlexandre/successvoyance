<?php
namespace App\Http\Controllers\Admin;

//  Models
use App\Models\User;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;

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
        $posts = Post::select('id')->count();
        $topics = Topic::select('id')->count();

        return view('admin.dashboard.index', compact('users', 'posts', 'topics'));
    }
}
