<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\AstrologicalSign as Sign;

class InsertAstrologicalsSigns extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sign::create([
            'name'      =>  'Bélier',
            'slug'      =>  'belier',
            'logo'      =>  'belier.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 3, 21),
            'ending_at' =>  Carbon::createFromDate(2017, 4, 20)
        ]);

        Sign::create([
            'name'      =>  'Taureau',
            'slug'      =>  'taureau',
            'logo'      =>  'taureau.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 4, 21),
            'ending_at' =>  Carbon::createFromDate(2017, 5, 21)
        ]);

        Sign::create([
            'name'      =>  'Gémeaux',
            'slug'      =>  'gemeau',
            'logo'      =>  'gemeau.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 5, 22),
            'ending_at' =>  Carbon::createFromDate(2017, 6, 21)
        ]);

        Sign::create([
            'name'      =>  'Cancer',
            'slug'      =>  'cancer',
            'logo'      =>  'cancer.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 6, 22),
            'ending_at' =>  Carbon::createFromDate(2017, 7, 22)
        ]);

        Sign::create([
            'name'      =>  'Lion',
            'slug'      =>  'lion',
            'logo'      =>  'lion.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 7, 23),
            'ending_at' =>  Carbon::createFromDate(2017, 8, 22)
        ]);

        Sign::create([
            'name'      =>  'Vierge',
            'slug'      =>  'vierge',
            'logo'      =>  'vierge.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 8, 23),
            'ending_at' =>  Carbon::createFromDate(2017, 9, 22)
        ]);

        Sign::create([
            'name'      =>  'Balance',
            'slug'      =>  'balance',
            'logo'      =>  'balance.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 9, 23),
            'ending_at' =>  Carbon::createFromDate(2017, 10, 22)
        ]);

        Sign::create([
            'name'      =>  'Scorpion',
            'slug'      =>  'scorpion',
            'logo'      =>  'scorpion.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 10, 23),
            'ending_at' =>  Carbon::createFromDate(2017, 11, 22)
        ]);

        Sign::create([
            'name'      =>  'Sagittaire',
            'slug'      =>  'sagitaire',
            'logo'      =>  'sagitaire.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 11, 23),
            'ending_at' =>  Carbon::createFromDate(2017, 12, 21)
        ]);

        Sign::create([
            'name'      =>  'Capricorne',
            'slug'      =>  'capricorne',
            'logo'      =>  'capricorne.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 12, 22),
            'ending_at' =>  Carbon::createFromDate(2017, 2, 19)
        ]);

        Sign::create([
            'name'      =>  'Verseau',
            'slug'      =>  'verseau',
            'logo'      =>  'verseau.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 01, 20),
            'ending_at' =>  Carbon::createFromDate(2017, 2, 19)
        ]);

        Sign::create([
            'name'      =>  'Poisson',
            'slug'      =>  'poisson',
            'logo'      =>  'poisson.png',
            'begin_at'  =>  Carbon::createFromDate(2017, 2, 20),
            'ending_at' =>  Carbon::createFromDate(2017, 03, 20)
        ]);
    }
}
