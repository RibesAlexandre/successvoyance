<?php
namespace App\Models\Telling;

use App\Models\Soothsayer;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TellingEmailResponse
 * @author Alexandre Ribes
 * @package App
 */
class TellingEmailResponse extends Model
{
    use DatePresenter;

    protected $table = 'telling_emails_responses';

    protected $fillable = ['email_send_id', 'soothsayer_id', 'content', 'identifier'];

    /**
     * Email parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
        return $this->belongsTo(TellingEmailSended::class, 'email_send_id');
    }

    /**
     * Voyant associé à la réponse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soothsayer()
    {
        return $this->belongsTo(Soothsayer::class, 'soothsayer_id');
    }
}
