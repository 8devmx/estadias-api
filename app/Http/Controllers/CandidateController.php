<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CandidateController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function getAllCandidates(Request $request)
    {
        $authenticatedCompany = auth()->user();

        if (!$authenticatedCompany) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        if ($authenticatedCompany->mail === 'techpech@protonmail.mx') {
            $candidates = DB::table('candidates')
            ->get();

        } else {
            $candidates = DB::table('candidates')
            ->where('company_id', $authenticatedCompany->id)
            ->get();
        }

        return response()->json(['candidates' => $candidates]);
    }

    public function showCandidates($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        return response()->json($candidate);
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
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,avif,jpg,gif,svg|max:2048',
            'company_id' => 'nullable|string', // Asegurarse que el campo company_id esté presente y sea válido
        ]);

        try {
            $authenticatedCompany = auth()->user();
            if (!$authenticatedCompany) {
                return response()->json(['error' => 'No autorizado'], 401);
            }

            $candidate = new Candidate();
            $candidate->name = $request->name;
            $candidate->phone = $request->phone;
            $candidate->email = $request->email;
            $candidate->address = $request->address;
            $candidate->sobre_mi = $request->sobre_mi;
            $candidate->experiencia = $request->experiencia;
            $candidate->educacion = $request->educacion;
            $candidate->habilidades = $request->habilidades;
            $candidate->intereses = $request->intereses;
            $candidate->premios = $request->premios;
            $candidate->company_id = $authenticatedCompany->id;

            if ($request->hasFile('foto_perfil')) {
                $image = $request->file('foto_perfil');
                $path = $image->store('profile_pictures', 'public');
                $candidate->foto_perfil = $path;
            }

            $candidate->save();
            return response()->json(['id' => $candidate->id], 201);
        } catch (\Exception $e) {
            $log = new Logger('candidate_errors');
            $log->pushHandler(new StreamHandler(storage_path('logs/candidate_errors.log'), Logger::ERROR));
            $log->error('Error inserting candidate: '.$e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.',
                'error' => $e->getMessage() // Remover esto en producción por razones de seguridad
            ], 500);
        }
    }

    public function deleteCandidates($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        $candidate->delete();
        return response()->json(["data" => "Candidate $id deleted successfully"]);
    }

    // public function updateCandidates(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => 'sometimes|required|string|max:80',
    //         'phone' => 'sometimes|required|string|max:15',
    //         // 'email' => 'sometimes|required|string|email|max:80|unique:candidates,email,' . $id,
    //         'email' => 'sometimes|required|string|email|max:80|unique:candidates,email,' . $id,
    //         'address' => 'sometimes|required|string|max:255',
    //         'sobre_mi' => 'nullable|string',
    //         'experiencia' => 'nullable|string',
    //         'educacion' => 'nullable|string',
    //         'habilidades' => 'nullable|string',
    //         'intereses' => 'nullable|string',
    //         'premios' => 'nullable|string',
    //         // 'foto_perfil' => 'nullable|image|mimes:jpeg,png,avif,jpg,gif,svg|max:2048'
    //         'foto_perfil' => 'nullable|string',
    //     ]);

    //     try {
    //         $candidate = Candidate::find($id);
    //         if (!$candidate) {
    //             return response()->json(["error" => "Candidate not found"], 404);
    //         }

    //         $candidate->name = $request->name ?? $candidate->name;
    //         $candidate->phone = $request->phone ?? $candidate->phone;
    //         $candidate->email = $request->email ?? $candidate->email;
    //         $candidate->address = $request->address ?? $candidate->address;
    //         $candidate->sobre_mi = $request->sobre_mi ?? $candidate->sobre_mi;
    //         $candidate->experiencia = $request->experiencia ?? $candidate->experiencia;
    //         $candidate->educacion = $request->educacion ?? $candidate->educacion;
    //         $candidate->habilidades = $request->habilidades ?? $candidate->habilidades;
    //         $candidate->intereses = $request->intereses ?? $candidate->intereses;
    //         $candidate->premios = $request->premios ?? $candidate->premios;

    //         if ($request->hasFile('foto_perfil')) {
    //             if ($candidate->foto_perfil) {
    //                 Storage::disk('public')->delete($candidate->foto_perfil);
    //             }
    //             $image = $request->file('foto_perfil');
    //             $path = $image->store('profile_pictures', 'public');
    //             $candidate->foto_perfil = $path;
    //         }else {
    //             // Asignar un valor predeterminado si no se proporciona una nueva imagen
    //             $candidate->foto_perfil = $candidate->foto_perfil ?: 'PerfilUsuarioNull.avif';
    //         }

    //         $candidate->save();
    //         return response()->json(["data" => "Candidate updated successfully"]);
    //     } catch (\Exception $e) {
    //         $log = new Logger('candidate_errors');
    //         $log->pushHandler(new StreamHandler(storage_path('logs/candidate_errors.log'), Logger::ERROR));
    //         $log->error('Error updating candidate: '.$e->getMessage());

    //         return response()->json(['message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.', 'error' => $e->getMessage()], 500);
    //     }
    // }


    public function updateCandidates(Request $request, $id)
{
    // Validar los campos del request
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
        'foto_perfil' => 'nullable|string',
    ]);

    try {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["error" => "Candidate not found"], 404);
        }

        $candidate->name = $request->name ?? $candidate->name;
        $candidate->phone = $request->phone ?? $candidate->phone;
        $candidate->email = $request->email ?? $candidate->email;
        $candidate->address = $request->address ?? $candidate->address;
        $candidate->sobre_mi = $request->sobre_mi ?? $candidate->sobre_mi;
        $candidate->experiencia = $request->experiencia ?? $candidate->experiencia;
        $candidate->educacion = $request->educacion ?? $candidate->educacion;
        $candidate->habilidades = $request->habilidades ?? $candidate->habilidades;
        $candidate->intereses = $request->intereses ?? $candidate->intereses;
        $candidate->premios = $request->premios ?? $candidate->premios;
        $candidate->foto_perfil = $request->foto_perfil ?? $candidate->foto_perfil;
        
        // Asignar valor para foto_perfil si se proporciona, o valor predeterminado si no
        // $candidate->foto_perfil = $request->foto_perfil ?: 'PerfilUsuarioNull.avif';

        $candidate->save();
        return response()->json(["data" => "Candidate updated successfully"]);
    } catch (\Exception $e) {
        $log = new Logger('candidate_errors');
        $log->pushHandler(new StreamHandler(storage_path('logs/candidate_errors.log'), Logger::ERROR));
        $log->error('Error updating candidate: '.$e->getMessage());

        return response()->json(['message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.', 'error' => $e->getMessage()], 500);
    }
}


    

    // Rutas sin protección
    public function updateCandidatesfront(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'nullable|string|max:80',
        'phone' => 'nullable|string|max:15',
        'email' => 'nullable|string|email|max:80|unique:candidates,email,' . $id,
        'address' => 'nullable|string|max:255',
        'sobre_mi' => 'nullable|string',
        'experiencia' => 'nullable|string',
        'educacion' => 'nullable|string',
        'habilidades' => 'nullable|string',
        'intereses' => 'nullable|string',
        'premios' => 'nullable|string',
        'foto_perfil' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    try {
        $candidate = Candidate::findOrFail($id);

        $fieldsToUpdate = [
            'name', 'phone', 'email', 'address', 'sobre_mi', 'experiencia',
            'educacion', 'habilidades', 'intereses', 'premios'
        ];

        foreach ($fieldsToUpdate as $field) {
            if ($request->has($field)) {
                $candidate->$field = $request->$field;
            }
        }

        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(env('FRONTEND_PUBLIC_PATH'), $filename);
            $candidate->foto_perfil = $filename;
        }

        $candidate->save();

        return response()->json(["message" => "Candidate updated successfully", "data" => $candidate]);
    } catch (ModelNotFoundException $e) {
        return response()->json(["error" => "Candidate not found"], 404);
    } catch (\Exception $e) {
        Log::error('Error updating candidate: '.$e->getMessage());
        return response()->json(['message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.', 'error' => $e->getMessage()], 500);
    }
}

    public function getAllCandidatesfront(Request $request)
    {
        $candidates = DB::table('candidates')->get();
        return response()->json(['candidates' => $candidates]);
    }

    public function showCandidatesfront($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        return response()->json($candidate);
    }

    public function deleteCandidatesfront($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["error" => "Candidate not found"], 404);
        }
        $candidate->delete();
        return response()->json(["data" => "Candidate $id deleted successfully"]);
    }

    public function insertCandidatesfront(Request $request)
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
            'company_id' => 'nullable|integer',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        try {
            $candidate = new Candidate();
            $candidate->name = $request->name;
            $candidate->phone = $request->phone;
            $candidate->email = $request->email;
            $candidate->address = $request->address;
            $candidate->sobre_mi = $request->sobre_mi ?? $candidate->sobre_mi;
            $candidate->experiencia = $request->experiencia ?? $candidate->experiencia;
            $candidate->educacion = $request->educacion ?? $candidate->educacion;
            $candidate->habilidades = $request->habilidades ?? $candidate->habilidades;
            $candidate->intereses = $request->intereses ?? $candidate->intereses;
            $candidate->premios = $request->premios ?? $candidate->premios;
            $candidate->company_id = $request->company_id ?? $candidate->company_id;
            
            if ($request->hasFile('foto_perfil')) {
                $image = $request->file('foto_perfil');
                $path = $image->store('profile_pictures', 'public');
                $candidate->foto_perfil = $path;
            }
    
            $candidate->save();
            return response()->json(['id' => $candidate->id], 201); // Devuelve el ID del candidato recién creado
        } catch (\Exception $e) {
            $log = new Logger('candidate_errors');
            $log->pushHandler(new StreamHandler(storage_path('logs/candidate_errors.log'), Logger::ERROR));
            $log->error('Error inserting candidate: '.$e->getMessage());
    
            return response()->json([
                'message' => 'Ocurrió un error en el servidor. Por favor, inténtelo de nuevo más tarde.',
                'error' => $e->getMessage() // Remover esto en producción por razones de seguridad
            ], 500);
        }
    }
    
}
