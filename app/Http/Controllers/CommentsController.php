<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Comment;
use App\Models\Soothsayer;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEditCommentRequest;

/**
 * Class CommentsController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * On récupère le commentaire à modifier
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if( !$comment->isEditable() ) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Vous n\'êtes pas autorisé à modifier ce commentaire.',
            ]);
        }

        return response()->json([
            'success'   =>  true,
            'content'   =>  view('components.comments.edit', compact('comment'))->render(),
        ]);
    }

    /**
     * Sauvegarde d'un commentaire
     *
     * @param CreateEditCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEditCommentRequest $request)
    {
        $comment = $request->user()->comments()->create($request->all());
        if( $request->has('stars') && $request->has('soothsayer_id') ) {
            $soothsayer = Soothsayer::findOrFail($request->input('soothsayer_id'));
            $soothsayer->update([
                'stars'     =>  $request->input('stars'),
                'ratings'   =>  $soothsayer->ratings + 1,
            ]);
        }
        return response()->json([
            'success'   =>  true,
            'clean'     =>  true,
            'content'   =>  view('components.comments.comment', compact('comment'))->render(),
            'method'    =>  'after',
            'element'   =>  '#list-comments',
            'to_clean'  =>  [
                'stars',
                'content'
            ]
        ]);
    }

    /**
     * Destruction d'un commentaire
     *
     * @param $id
     * @param CreateEditCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, CreateEditCommentRequest $request)
    {
        $comment = Comment::findOrFail($id);
        if( !$request->user()->can('update', $comment) ) {
            return response()->json([
                'success'   =>  false,
                'alert'     =>  'Vous n\'êtes pas autorisé à modifier le commentaire d\'un autre utilisateur.',
                'type'      =>  'error'
            ]);
        }

        $comment->update($request->all());
        return response()->json([
            'success'   =>  true,
            'content'   =>  nl2br(strip_tags($comment->content)),
            'method'    =>  'html',
            'element'   =>  '#comment_content_' . $comment->id,
        ]);
    }

    /**
     * Suppression d'un commentaire
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $comment = Comment::findOrFail($id);
        if( !Auth::user()->can('destroy', $comment) ) {
            return response()->json([
                'success'   =>  false,
                'alert'     =>  true,
                'message'   =>  'Vous n\'êtes pas autorisé à supprimer le commentaire d\'un autre utilisateur.',
                'type'      =>  'error'
            ]);
        }

        $comment->delete();
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre commentaire a correctement été supprimé.',
            'id'        =>  'comment_' . $id,
        ]);

    }
}
