<?php

namespace App\Models;

use App\Presenters\ConfigPresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Config
 * @author Alexandre Ribes
 * @package App
 */
class Config extends Model
{
    use ConfigPresenter;

    protected $table = 'config';

    protected $fillable = ['key', 'value', 'type'];

    public $timestamps = false;
}
