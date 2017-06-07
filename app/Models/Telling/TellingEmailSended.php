<?php
namespace App\Models\Telling;

use App\Models\User;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TellingEmailSended
 * @author Alexandre Ribes
 * @package App\Models\Telling
 */
class TellingEmailSended extends Model
{
    use DatePresenter;

    protected $table = 'telling_emails_sended';

    protected $fillable = ['user_id', 'topic', 'identifier', 'content'];

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
     * Réponse associée à l'email
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function response()
    {
        return $this->hasOne(TellingEmailResponse::class, 'email_send_id')->with('soothsayer');
    }

    public function responses()
    {
        return $this->hasMany(TellingEmailResponse::class, 'identifier', 'identifier');
    }

}
