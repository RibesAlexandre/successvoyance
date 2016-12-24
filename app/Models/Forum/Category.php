<?php
namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class Category extends Model
{
    use SoftDeletes;

    protected $table = 'forum_categories';

    protected $fillable = ['name', 'slug', 'content', 'position', 'deleted_at'];

    public $timestamps = false;

    /**
     * Forums de la catégorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forums()
    {
        return $this->hasMany(Forum::class, 'category_id');
    }
}
