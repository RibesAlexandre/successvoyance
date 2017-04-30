<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TellingEmailUser
 * @author Alexandre Ribes
 * @package App\Models
 */
class TellingEmailUser extends Model
{
    protected $table = 'telling_emails_users';

    protected $fillable = ['user_id', 'email_id', 'total'];

    /**
     * Utilisateur associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Offre email associée
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
        return $this->belongsTo(TellingEmail::class, 'email_id');
    }
}
