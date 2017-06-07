<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recruitment
 * @author Alexandre Ribes
 * @package App\Models
 */
class Recruitment extends Model
{
    protected $table = 'recruitments';

    protected $fillable = ['title', 'slug', 'content'];
}
