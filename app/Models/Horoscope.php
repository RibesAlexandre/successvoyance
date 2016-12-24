<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Horoscope
 * @author Alexandre Ribes
 * @package App\Models
 */
class Horoscope extends Model
{
    use SoftDeletes;

    protected $table = 'horoscopes';

    protected $fillable = ['name', 'slug', 'content', 'sign_id', 'deleted_at'];

    protected $dates = ['deleted_at'];

    /**
     * Signe astrologique associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sign()
    {
        return $this->belongsTo(AstrologicalSign::class, 'sign_id');
    }
}
