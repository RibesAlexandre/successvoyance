<?php
namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Picture
 * @author Alexandre Ribes
 * @package App
 */
class Picture extends Model
{
    protected $fillable = ['name', 'file'];
}
