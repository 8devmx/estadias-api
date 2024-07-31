<?php

namespace App\Http\Controllers;

use App\Models\Vacancie;
use Illuminate\Http\Request;

class VacancieController extends Controller
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

    // public function getAllVacancies()
    // {
    //     $vacancies = Vacancie::all();
    //     return response()->json(["vacancies" => $vacancies]);
    // }

    public function getAllVacancies(Request $request)
    {
        // Obtiene el usuario autenticado
        $authenticatedCompany = auth()->user();

        // Verifica si el usuario está autenticado
        if (!$authenticatedCompany) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        // Verifica si el email del usuario autenticado es techpech@protonmail.mx
        if ($authenticatedCompany->mail === 'techpech@protonmail.mx') {
            // Si es así, obtiene todos los registros
            $vacancies = Vacancie::all();
        } else {
            // De lo contrario, obtiene solo los registros de la empresa autenticada
            $vacancies = Vacancie::where('company_id', $authenticatedCompany->id)->get();
        }

        return response()->json(['vacancies' => $vacancies]);
    }


    public function showVacancies($id)
    {
        $vacancies = Vacancie::where('id', $id)->get();
        return response($vacancies);
    }
    public function insertVacancies(Request $request)
    {
        $vacancies = new Vacancie();
        $vacancies->state = $request->state;
        $vacancies->category = $request->category;
        $vacancies->title = $request->title;
        $vacancies->company_id = $request->company_id;
        $vacancies->description = $request->description;
        $vacancies->type = $request->type;
        $vacancies->save();
        return response()->json(['message' => 'Vacancie created successfully', 'vacancies' => $vacancies], 201);
    }
    public function deleteVacancies($id)
    {
        $vacancies = Vacancie::where('id', $id)->first();
        if (!$vacancies) {
            return response()->json(["error" => "Vacancie not found"]);
        }
        $vacancies->delete();
        return response()->json(["data" => "Vacancie $id deleted successfully"]);
    }

    public function updateVacancies(Request $request, $id)
    {
        $vacancies = Vacancie::where('id', $id)->first();
        $vacancies->state = $request->state;
        $vacancies->category = $request->category;
        $vacancies->title = $request->title;
        $vacancies->company_id = $request->company_id;
        $vacancies->description = $request->description;
        $vacancies->type = $request->type;
        $vacancies->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }
}