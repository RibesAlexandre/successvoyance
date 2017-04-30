<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Newsletter
 * @author Alexandre Ribes
 * @package App\Models
 */
class Newsletter extends Model
{
    use SoftDeletes;

    protected $table = 'newsletters';

    protected $fillable = ['email', 'user_id', 'deleted_at'];

    protected $dates = ['deleted_at'];

    /**
     * Utilisateur associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
