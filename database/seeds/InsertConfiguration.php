<?php

use Illuminate\Database\Seeder;

/**
 * Class InsertConfiguration
 * @author Alexandre Ribes
 */
class InsertConfiguration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Config::create([
            'key'   =>  'name',
            'value' =>  'Success Voyance',
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'description',
            'value' =>  'Mon super site de voyance',
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'logo',
            'value' =>  asset('imgs/components/logo_dark.png'),
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'cover_home',
            'value' =>  asset('imgs/design/covers/banner.jpg'),
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'cover_login',
            'value' =>  asset('imgs/design/covers/together.jpg'),
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'cover_password',
            'value' =>  asset('imgs/design/covers/gift.jpg'),
            'type'  =>  'string',
        ]);

        \App\Config::create([
            'key'   =>  'cover_signs',
            'value' =>  asset('imgs/design/covers/moons.jpg'),
            'type'  =>  'string',
        ]);
    }
}
