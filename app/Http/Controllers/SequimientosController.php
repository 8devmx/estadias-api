<?php

namespace App\Http\Controllers;

use App\Models\Sequimiento;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function searchByNameClientId(Request $request)
    {
        $nameClientId = $request->input('name_client_id');
        
        $sequimientos = DB::table('sequimientos')
            ->join('lead', 'sequimientos.name_client_id', '=', 'lead.id')
            ->select('sequimientos.*', 'lead.name as name_client_lead', 'lead.status as status_lead')
            ->where('sequimientos.name_client_id', $nameClientId)
            ->get();
 
        return response()->json(['sequimientos' => $sequimientos]);
    }   

    public function getAllSequimientos()
    {
        $sequimientos = DB::table('sequimientos')
        ->join('lead', 'sequimientos.name_client_id', '=', 'lead.id')
        ->select('sequimientos.*', 'lead.name as name_client_lead', 'lead.status as status_lead')
        ->get();

        return response()->json(['sequimientos' => $sequimientos]);


    }

    public function showSequimientos($id)
    {
        $Sequimientos = Sequimiento::where('id', $id)->get();
        return response($Sequimientos);
    }
    public function insertSequimientos(Request $request)
    {
        $Sequimientos = new Sequimiento();
        $Sequimientos->name_client_id = $request->name_client_id;
        $Sequimientos->status_id = $request->status_id;
        $Sequimientos->message = $request->message;
        $Sequimientos->name_administrator = $request->name_administrator;
        $Sequimientos->date = $request->date;
        $Sequimientos->save();

        return response()->json(['message' => 'Sequimiento se creo exitosamente', 'Sequimientos' => $Sequimientos], 201);
    }

}