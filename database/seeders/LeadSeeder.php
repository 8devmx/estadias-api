<?php

namespace Database\Seeders;

use App\Models\Lead;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;

class leadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$table = new lead();
        $table->name = "Rose Crosby";
		$table->phone = "(529) 114-6448";
		$table->mail= "aptent@icloud.couk";
		$table->state = "Opolskie";
		$table->city ="Lillehammer";
		$table->source = "amet nulla. Donec non justo.";
		$table->interest= "orci sem eget massa. Suspendisse eleifend. Cras sed leo.";
		$table->message = "Morbi metus.";
		$table->status_id = "1";
		$table->company_id = "6";

        $table->save();

		$table = new lead();
        $table->name = "Virginia Avery";
		$table->phone = "1-286-737-4401";
		$table->mail= "sit.amet.consectetuer@yahoo.couk";
		$table->state = "Huáběi";
		$table->city = "Kimberley";
		$table->source = "arcu. Sed eu nibh vulputate";
		$table->interest = "non arcu. Vivamus sit amet risus. Donec egestas. Aliquam";
		$table->message = "mattis Integer eu lacus. Quisque imperdiet,";
		$table->status_id = "1";
		$table->company_id = "11";
		
        $table->save();

        $table = new lead();

        $table->name = "Hop Townsend";
		$table->phone = "(831) 514-9841";
		$table->mail = "vel.lectus@hotmail.edu";
		$table->state = "Free State";
		$table->city = "North-Eastern Islands";
		$table->source = "dis parturient montes, nascetur ridiculus";
		$table->interest = "tristique senectus et netus et";
		$table->message = "eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede";
		$table->status_id = "1";
		$table->company_id = "3"; 
        
        $table->save();

        $table = new lead();
        $table->name = "Jolie England";
		$table->phone = "(395) 964-5189";
		$table->mail = "justo.praesent@outlook.edu";
		$table->state = "North Island";
		$table->city = "Alingsås";
		$table->source = "vel turpis. Aliquam adipiscing lobortis";
		$table->interest = "iaculis, lacus pede sagittis augue, eu";
		$table->message = "Curabitur consequat, lectus sit";
		$table->status_id = "2";
		$table->company_id = "8";

        $table->save();

    
        $table = new lead();
        $table->name = "Lydia Beasley";
		$table->phone = "(306) 472-2674";
		$table->mail = "mi.ac@google.ca";
		$table->state = "Dōngběi";
		$table->city = "Ranchi";
		$table->source = "felis eget varius ultrices, mauris";
		$table->interest = "dictum placerat, augue. Sed";
		$table->message = "elit. Aliquam auctor, velit eget laoreet posuere, enim nisl elementum purus, accumsan interdum libero dui";
		$table->status_id = "2";
		$table->company_id = "12";

        $table->save();


    }
}
