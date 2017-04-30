<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\TellingEmailPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TellingEmail
 * @author Alexandre Ribes
 * @package App\Models
 */
class TellingEmail extends Model
{
    use SoftDeletes, TellingEmailPresenter;

    protected $table = 'telling_emails';

    protected $fillable = ['name', 'slug', 'content', 'amount', 'quantity', 'popular', 'enabled', 'deleted_at'];

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
