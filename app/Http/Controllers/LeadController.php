<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
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

    public function getAllLeads()
    {
        $leads = Lead::all();
    return response()->json(["leads" => $leads]);
    }

    public function showLeads($id)
    {
        $leads = Lead::where('id', $id)->get();
        return response($leads);
    }

    public function insertLeads(Request $request)
    {
        $leads = new Lead();
        $leads->name = $request->name;
        $leads->thone = $request->thone;
        $leads->mail = $request->mail;
        $leads->state_id = $request->state_id;
        $leads->city = $request->city;
        $leads->sources_id = $request->sources_id;
        $leads->interest_id = $request->interest_id;
        $leads->message = $request->message;
        $leads->status_id = $request->status_id;
        $leads->company_id = $request->company_id;
        $leads->save();
        return response()->json(['message' => 'Lead created successfully', 'leads' => $leads], 201);
    }
    public function deleteLeads($id)
    {
        $leads = Lead::where('id', $id)->first();
        if (!$leads) {
            return response()->json(["error" => "Usuario no encontrado"]);
        }
        $leads->delete();
        return response()->json(["data" => "El usuario $id se ha eliminado exitosamente"]);
    }
    public function updateLeads(Request $request, $id)
    {
        $leads = Lead::where('id', $id)->first();
        $leads->name = $request->name;
        $leads->thone = $request->thone;
        $leads->mail = $request->mail;
        $leads->state_id = $request->state_id;
        $leads->city = $request->city;
        $leads->sources_id = $request->sources_id;
        $leads->interest_id = $request->interest_id;
        $leads->message = $request->message;
        $leads->status_id = $request->status_id;
        $leads->company_id = $request->company_id;
        $leads->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }
}
