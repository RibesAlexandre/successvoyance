<?php
namespace App\Models\Content;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @author Alexandre Ribes
 * @package App
 */
class Page extends Model
{
    use SoftDeletes, DatePresenter;

    protected $fillable = ['name', 'slug', 'content', 'created_at', 'updated_at', 'deleted_at', 'deletable'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /*
     * Images de la page
     */
    public function pictures()
    {
        return $this->belongsToMany(Picture::class, 'pages_pictures', 'page_id');
    }

    /**
     * Détermine le slug et le nom à la volée
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = str_slug($value);
    }
}
