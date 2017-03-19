<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Soothsayer
 * @author Alexandre Ribes
 * @package App\Models
 */
class Soothsayer extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'nickname', 'code', 'phone', 'content', 'picture', 'stars', 'ratings', 'deleted_at'];

    protected $dates = ['deleted_at'];

    public $timestamps = false;
}
