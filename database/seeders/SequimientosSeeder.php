<?php

namespace Database\Seeders;

use App\Models\Sequimiento;

use Illuminate\Database\Seeder;

class SequimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Sequimiento();

        $table->name_client_id = "4";
        $table->status_id = "4";
        $table->message = "Curabitur egestas nunc sed libero. Proin sed turpis";
        $table->name_administrator = "Amos Coffey";
        $table->date = "2023-08-27";

        $table->save();
    }
}
