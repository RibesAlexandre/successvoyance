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
        \App\Models\Config::create([
            'key'   =>  'name',
            'value' =>  'Success Voyance',
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'description',
            'value' =>  'Mon super site de voyance',
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'email',
            'value' =>  'ribes.alexandre@gmail.com',
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'logo',
            'value' =>  asset('imgs/design/logo.jpg'),
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'cover_home',
            'value' =>  asset('imgs/design/covers/banner.jpg'),
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'cover_login',
            'value' =>  asset('imgs/design/covers/together.jpg'),
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'cover_password',
            'value' =>  asset('imgs/design/covers/gift.jpg'),
            'type'  =>  'string',
        ]);

        \App\Models\Config::create([
            'key'   =>  'cover_signs',
            'value' =>  asset('imgs/design/covers/moons.jpg'),
            'type'  =>  'string',
        ]);
    }
}
