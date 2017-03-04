<?php
namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 * @author Alexandre Ribes
 * @package App
 */
class Link extends Model
{
    protected $fillable = ['name', 'slug', 'link', 'position', 'container', 'parent_id'];

    public $timestamps = false;

    /**
     * Lien parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Link::class, 'parent_id');
    }

    /**
     * Liens enfants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany(Link::class, 'parent_id');
    }
}
