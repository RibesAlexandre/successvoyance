<?php
namespace App\Presenters;

/**
 * Class ConfigPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait ConfigPresenter
{
    /**
     * @return bool|int|string
     */
    public function getValueAttribute($value)
    {
        if( $this->type == 'string' ) {
            return is_null($value) ? '' : (string) $value;
        } else if( $this->type == 'integer' ) {
            return is_null($value) ? 0 : (int) $value;
        } else if( $this->type == 'boolean' ) {
            return ($value == 0 || $value == '0') ? false : true;
        } else {
            return is_null($value) ? null : $value;
        }
    }
}