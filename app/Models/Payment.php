<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @author Alexandre Ribes
 * @package App\Models
 */
class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['amount', 'user_id', 'payment_id', 'card_id', 'card_expire_month', 'card_expire_year', 'service'];
}
