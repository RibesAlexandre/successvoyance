<?php
namespace App\Presenters;

trait CarouselPresenter
{
    public function picture()
    {
        return !is_null($this->picture) ? asset('uploads/carousels/' . $this->picture) : '';
    }
}