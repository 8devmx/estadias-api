<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Str;

class LandingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $landings = DB::table('landings')->get();

        foreach ($landings as $landing) {
            DB::table('landings')->where('id', $landing->id)->update([
                'slugs' => Str::slug('landing-' . $landing->id)  // php artisan db:seed --class=LandingsTableSeeder
            ]);
        }
    }
}
