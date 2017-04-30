<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Autorisation pour l'utilisateur de mettre à jour un commentaire
     *
     * @param Comment $comment
     * @param User $user
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Autorisation pour l'utilisateur de supprimer un commentaire
     *
     * @param Comment $comment
     * @param User $user
     * @return bool
     */
    public function destroy(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
