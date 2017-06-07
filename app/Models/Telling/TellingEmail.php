<?php
namespace App\Models\Telling;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use App\Presenters\TellingEmailPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TellingEmail
 * @author Alexandre Ribes
 * @package App\Models
 */
class TellingEmail extends Model
{
    use SoftDeletes, TellingEmailPresenter, DatePresenter;

    protected $table = 'telling_emails';

    protected $fillable = ['name', 'slug', 'content', 'amount', 'quantity', 'popular', 'enabled', 'deleted_at'];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Emails actifgs
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Rajout des centimes pour l'offre
     *
     * @param $value
     *
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }
     */
}
