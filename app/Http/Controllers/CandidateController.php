<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;

class CandidateController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function getAllCandidates()
    {
        $Candidates = Candidate::all();
        return response()->json(["Candidates" => $Candidates]);
    }

    public function showCandidates($id)
    {
        $Candidates = Candidate::find($id);
        if (!$Candidates) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        return response()->json($Candidates);
    }

    public function insertCandidates(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:80',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:80|unique:candidates,email',
            'address' => 'required|string|max:255',
            'sobre_mi' => 'nullable|string',
            'experiencia' => 'nullable|string',
            'educacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'intereses' => 'nullable|string',
            'premios' => 'nullable|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $Candidates = new Candidate();
            $Candidates->name = $request->name;
            $Candidates->phone = $request->phone;
            $Candidates->email = $request->email;
            $Candidates->address = $request->address;
            $Candidates->sobre_mi = $request->sobre_mi;
            $Candidates->experiencia = $request->experiencia;
            $Candidates->educacion = $request->educacion;
            $Candidates->habilidades = $request->habilidades;
            $Candidates->intereses = $request->intereses;
            $Candidates->premios = $request->premios;

            if ($request->hasFile('foto_perfil')) {
                $image = $request->file('foto_perfil');
                $path = $image->store('profile_pictures', 'public');
                $Candidates->foto_perfil = $path;
            }

            $Candidates->save();
            return response()->json(['message' => 'Candidate created successfully', 'Candidates' => $Candidates], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteCandidates($id)
    {
        $Candidates = Candidate::find($id);
        if (!$Candidates) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        $Candidates->delete();
        return response()->json(["data" => "Candidate $id deleted successfully"]);
    }

    public function updateCandidates(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|string|max:80',
            'phone' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|string|email|max:80|unique:candidates,email,' . $id,
            'address' => 'sometimes|required|string|max:255',
            'sobre_mi' => 'nullable|string',
            'experiencia' => 'nullable|string',
            'educacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'intereses' => 'nullable|string',
            'premios' => 'nullable|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $Candidates = Candidate::find($id);
            if (!$Candidates) {
                return response()->json(["error" => "Candidate not found"], 404);
            }

            $Candidates->name = $request->name ?? $Candidates->name;
            $Candidates->phone = $request->phone ?? $Candidates->phone;
            $Candidates->email = $request->email ?? $Candidates->email;
            $Candidates->address = $request->address ?? $Candidates->address;
            $Candidates->sobre_mi = $request->sobre_mi ?? $Candidates->sobre_mi;
            $Candidates->experiencia = $request->experiencia ?? $Candidates->experiencia;
            $Candidates->educacion = $request->educacion ?? $Candidates->educacion;
            $Candidates->habilidades = $request->habilidades ?? $Candidates->habilidades;
            $Candidates->intereses = $request->intereses ?? $Candidates->intereses;
            $Candidates->premios = $request->premios ?? $Candidates->premios;

            if ($request->hasFile('foto_perfil')) {
                if ($Candidates->foto_perfil) {
                    Storage::disk('public')->delete($Candidates->foto_perfil);
                }
                $image = $request->file('foto_perfil');
                $path = $image->store('profile_pictures', 'public');
                $Candidates->foto_perfil = $path;
            }

            $Candidates->save();
            return response()->json(["data" => "Candidate updated successfully"]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }
}
