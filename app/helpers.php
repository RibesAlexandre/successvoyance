<?php
use Illuminate\Support\Facades\Route;
if( !function_exists('isInRoute') ) {
    function isInRoute($route)
    {
        if( is_array($route) ) {
            foreach( $route as $r ) {
                if( !is_null(Route::current()) && Route::current()->getName() === $r ) {
                    return true;
                }
            }
            return false;
        }

        if( !is_null(Route::current()) && Route::current()->getName() === $route ) {
            return true;
        }
    }
}

if( !function_exists('active') ) {
    function active($route, $returnClass = false)
    {
        if( !is_null(Route::current()) && Route::current()->getName() == $route ) {
            if( $returnClass ) {
                return ' class=active';
            }
            return ' active';
        }
        return '';
    }
}