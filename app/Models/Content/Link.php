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
    protected $fillable = ['name', 'slug', 'link', 'position', 'container'];

    public $timestamps = false;
}
