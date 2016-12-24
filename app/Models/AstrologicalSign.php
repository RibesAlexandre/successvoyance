<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AstrologicalSign
 * @author Alexandre Ribes
 * @package App
 */
class AstrologicalSign extends Model
{
    protected $table = 'astrological_signs';

    protected $fillable = ['name', 'slug', 'logo', 'content', 'begin_at', 'ending_at', 'deleted_at'];

    protected $dates = ['begin_at', 'ending_at', 'deleted_at'];
}
