<?php

namespace App\Http\Controllers;

use App\Models\Sequimiento;
use Illuminate\Http\Request;

class SequimientosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllSequimientos()
    {
        $Sequimientos = Sequimiento::all();
        return response()->json(["Sequimientos" => $Sequimientos]);
    }

    public function showSequimientos($id)
    {
        $Sequimientos = Sequimiento::where('id', $id)->get();
        return response($Sequimientos);
    }
    public function insertSequimientos(Request $request)
    {
        $Sequimientos = new Sequimiento();
        $Sequimientos->name_client = $request->name_client;
        $Sequimientos->status = $request->status;
        $Sequimientos->message = $request->message;
        $Sequimientos->name_administrator = $request->name_administrator;
        $Sequimientos->date = $request->date;
        $Sequimientos->save();

        return response()->json(['message' => 'Sequimiento se creo exitosamente', 'Sequimientos' => $Sequimientos], 201);
    }

}