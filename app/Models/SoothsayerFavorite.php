<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SoothsayerFavorite
 * @author Alexandre Ribes
 * @package App\Models
 */
class SoothsayerFavorite extends Model
{
    protected $table = 'soothsayers_favorites';

    protected $fillable = ['id', 'soothsayer_id', 'user_id'];

    public $timestamps = false;
}
