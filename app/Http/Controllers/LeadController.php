<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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


    public function getAllLeads(Request $request)
    {
        $authenticatedCompany = auth()->user();

        if (!$authenticatedCompany) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        // Verifica si el email del usuario autenticado es sanpech@protonmail.mx
        if ($authenticatedCompany->mail === 'sanpech@protonmail.mx') {
            // Si es así, obtiene todos los registros
            $leads = DB::table('lead')
                ->join('company', 'lead.company_id', '=', 'company.id')
                ->join('status', 'lead.status_id', '=', 'status.id')
                ->select('lead.*', 'company.name as company_name', 'status.name as status_name')
                ->get();
        } else {
            // De lo contrario, obtiene solo los registros de la empresa autenticada
            $leads = DB::table('lead')
                ->join('company', 'lead.company_id', '=', 'company.id')
                ->join('status', 'lead.status_id', '=', 'status.id')
                ->select('lead.*', 'company.name as company_name', 'status.name as status_name')
                ->where('lead.company_id', $authenticatedCompany->id)
                ->get();
        }

        return response()->json(['leads' => $leads]);
    }


    public function showLeads($id)
    {

        $lead = DB::table('lead')
        ->join('company', 'lead.company_id', '=', 'company.id')
        ->join('status', 'lead.status_id', '=', 'status.id')
        ->select('lead.*', 'company.name as company_name', 'status.name as status_name')
        ->where('lead.id', $id)
        ->first();

    return response()->json($lead);
    }

    public function insertLeads(Request $request)
    {
        // valida si el campo mail existe
        $validator = Validator::make($request->all(), [
            'mail' => 'required|string|email|max:255',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si el correo ya existe en la base de datos
        $existingLead = Lead::where('mail', $request->mail)->first();

        if ($existingLead) {
            // Si el correo ya existe, retornar un mensaje de error
            return response()->json(['message' => 'El correo ya está registrado'], 409);
        }

        // Si el correo no existe, proceder con la inserción
        $leads = new Lead();
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
        $leads->save();

        return response()->json(['message' => 'Lead se creo exitosamente', 'lead' => $leads], 201);
    }

    public function deleteLeads($id)
    {
        $leads = Lead::where('id', $id)->first();
        if (!$leads) {
            return response()->json(["error" => "Usuario no encontrado"]);
        }
        $leads->delete();
        return response()->json(["message" => "El usuario $id se ha eliminado exitosamente"]);
    }
    public function updateLeads(Request $request, $id)
    {
        $leads = Lead::where('id', $id)->first();
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
        $leads->save();
        return response()->json(["message" => "Se actualizó correctamente"]);
    }
}
