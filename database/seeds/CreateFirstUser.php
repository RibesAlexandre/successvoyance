<?php

use Illuminate\Database\Seeder;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nickname'  =>  'SquallX',
            'name'      =>  'Ribes',
            'firstname' =>  'Alexandre',
            'email'     =>  'ribes.alexandre@gmail.com',
            'password'  =>  bcrypt('squallx'),
        ]);

        \App\Models\User::create([
            'nickname'  =>  'Nici Cante',
            'name'      =>  'Canteloube',
            'firstname' =>  'Anaïs',
            'email'     =>  'anais6639@hotmail.com ',
            'password'  =>  bcrypt('azerty'),
        ]);
    }
}
