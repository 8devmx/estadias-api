<?php

namespace Database\Seeders;

use App\Models\Status;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$table = new Status();
        $table->name = "Buzon";

        $table->save();

		$table = new Status();
        $table->name = "No contactado";

        $table->save();

		$table = new Status();
        $table->name = "No le intereso";

        $table->save();

		$table = new Status();
        $table->name = "Le intereso";

        $table->save();

		$table = new Status();
        $table->name = "En espera";

        $table->save();

    }
}
