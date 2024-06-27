<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $leads = Lead::where('id', $id)->first();
        return response($leads);
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
        $leads->status = $request->status;
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
        $leads->phone = $request->thone;
        $leads->mail = $request->mail;
        $leads->state = $request->state;
        $leads->city = $request->city;
        $leads->source = $request->source;
        $leads->interest = $request->interest;
        $leads->message = $request->message;
        $leads->status = $request->status;
        $leads->company_id = $request->company_id;
        $leads->save();
        return response()->json(["message" => "Se actualizó correctamente"]);
    }
}
