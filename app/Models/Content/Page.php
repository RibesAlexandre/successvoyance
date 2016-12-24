<?php
namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @author Alexandre Ribes
 * @package App
 */
class Page extends Model
{
    protected $fillable = ['name', 'slug', 'content', 'deleted_at', 'deletable'];

    protected $dates = ['deleted_at'];
}
