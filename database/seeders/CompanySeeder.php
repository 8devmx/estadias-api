<?php

namespace Database\Seeders;

use App\Models\Company;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $table = new Company();

         $table->name = "";
         $table->mail = "";
         $table->phone = "";
         $table->contact = "";
         $table->logo = "";      

         $table->save();
    }
}
