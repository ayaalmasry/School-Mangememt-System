<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\specializations;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
        ];
        foreach ($specializations as $S) {
            specializations::create(['Name' => $S]);
        }
    }
    }

