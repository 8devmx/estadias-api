<?php

namespace App\Http\Controllers;

use App\Models\Vacancie;
use App\Models\Estado;
use Illuminate\Http\Request;

class VacancieController extends Controller
{
    // Otros métodos existentes...

    public function getAllVacanciesWithStates(Request $request)
    {
        // Obtiene el usuario autenticado
        $authenticatedCompany = auth()->user();

        // Verifica si el usuario está autenticado
        if (!$authenticatedCompany) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        // Verifica si el email del usuario autenticado es techpech@protonmail.mx
        if ($authenticatedCompany->mail === 'techpech@protonmail.mx') {
            // Si es así, obtiene todos los registros con el nombre del estado
            $vacancies = Vacancie::select(
                'vacancies.id', 'vacancies.state', 'vacancies.category', 'vacancies.title', 'vacancies.company_id', 
                'vacancies.description', 'vacancies.type', 'estados.estado as state_name'
            )
            ->leftJoin('estados', 'vacancies.state', '=', 'estados.id')
            ->get();
        } else {
            // De lo contrario, obtiene solo los registros de la empresa autenticada con el nombre del estado
            $vacancies = Vacancie::select(
                'vacancies.id', 'vacancies.state', 'vacancies.category', 'vacancies.title', 'vacancies.company_id', 
                'vacancies.description', 'vacancies.type', 'estados.estado as state_name'
            )
            ->leftJoin('estados', 'vacancies.state', '=', 'estados.id')
            ->where('vacancies.company_id', $authenticatedCompany->id)
            ->get();
        }

        return response()->json(['vacancies' => $vacancies]);
    }

    // Otros métodos existentes...
}
