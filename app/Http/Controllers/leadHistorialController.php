<?php

namespace App\Http\Controllers;

use App\Models\LeadHistorials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LeadHistorialController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getAllLeadHistorial()
    {
        // $leads = DB::table('lead_historials')
        //     ->join('company', 'lead_historials.company_id', '=', 'company.id')
        //     ->select('lead_historials.*', 'company.name as company_name')
        //     ->get();

        // return response()->json(['leads' => $leads]);

        $leads = DB::table('lead_historials')
            ->join('company', 'lead_historials.company_id', '=', 'company.id')
            ->join('status', 'lead_historials.status_id', '=', 'status.id')
            ->select('lead_historials.*', 'company.name as company_name', 'status.name as status_name')
            ->orderBy('lead_historials.created_at', 'asc')  // Ordenar por fecha de creación de forma ascendente
            ->get();

        return response()->json(['leads' => $leads]);
    }

    public function showLeadHistorial($id)
    {
        $lead = LeadHistorials::where('id', $id)->first();
        return response()->json($lead);
    }

    public function insertLeadHistorial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $leads = new LeadHistorials();
        $leads->name = $request->name;
        $leads->phone = $request->phone;
        $leads->mail = $request->mail;
        $leads->state = $request->state;
        $leads->city = $request->city;
        $leads->source = $request->source;
        $leads->interest = $request->interest;
        $leads->message = $request->message;
        $leads->status_id = $request->status_id;
        $leads->company_id = $request->company_id;
        $leads->name_client = $request->name_client;
        $leads->save();

        return response()->json(['message' => 'Lead creado exitosamente', 'lead' => $leads], 201);
    }

    // public function deleteHistorial($id)
    // {
    //     $lead = LeadHistorials::where('id', $id)->first();
    //     if (!$lead) {
    //         return response()->json(["error" => "Usuario no encontrado"]);
    //     }
    //     $lead->delete();
    //     return response()->json(["message" => "El usuario $id se ha eliminado exitosamente"]);
    // }

    // public function updateLeads(Request $request, $id)
    // {
    //     $lead = LeadHistorials::where('id', $id)->first();
    //     $lead->name = $request->name;
    //     $lead->phone = $request->phone;
    //     $lead->mail = $request->mail;
    //     $lead->state = $request->state;
    //     $lead->city = $request->city;
    //     $lead->source = $request->source;
    //     $lead->interest = $request->interest;
    //     $lead->message = $request->message;
    //     $lead->status = $request->status;
    //     $lead->company_id = $request->company_id;
    //     $lead->save();
    //     return response()->json(["message" => "Se actualizó correctamente"]);
    // }
}