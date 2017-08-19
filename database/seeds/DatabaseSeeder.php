<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(InsertPermission::class);
        $this->call(CreateFirstUser::class);
        $this->call(InsertAstrologicalsSigns::class);
        $this->call(InsertConfiguration::class);
        $this->call(permissions::class);
    }
}
