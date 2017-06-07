<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use DevDojo\Chatter\Models\Discussion;
use DevDojo\Chatter\Models\Post;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Liste des utilisateurs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::oldest()->paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Vue d'un utilisateur
     *
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $user = User::with('countTopics', 'countMessages', 'countComments')
            ->with(['comments' => function($query) {
                $query->latest()->take(5)->get();
            }])
            ->with(['topics' => function($query) {
                $query->latest()->take(5)->get();
            }])
            ->with(['posts' => function($query) {
                $query->latest()->take(5)->get();
            }])
            ->where('id', $id)
            ->first();
        return view('auth.account.index')->with('user', $user);
    }

    /**
     * Commentaires de l'utilisateur
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments($id)
    {
        $user = User::with('countTopics', 'countMessages', 'countComments')
            ->where('id', $id)
            ->firstOrFail();
        $comments = Comment::where('user_id', $user->id)->with('soothsayer', 'horoscope')->latest()->paginate(10);
        return view('users.comments', compact('user', 'comments'));
    }

    /**
     * Sujets de l'utilisateur
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topics($id)
    {
        $user = User::with('countTopics', 'countMessages', 'countComments')
            ->where('id', $id)
            ->firstOrFail();
        $topics = Discussion::where('user_id', $user->id)->latest()->paginate(10);
        return view('users.topics', compact('user', 'topics'));
    }

    /**
     * Messages de l'utilisateur
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function posts($id)
    {
        $user = User::with('countTopics', 'countMessages', 'countComments')
            ->where('id', $id)
            ->firstOrFail();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        return view('users.posts', compact('user', 'posts'));
    }
}
