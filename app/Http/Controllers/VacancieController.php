<?php

namespace App\Http\Controllers;

use App\Models\Vacancie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function getAllVacancies()
    {
        
    
            $vacancies = DB::table('vacancies') // Nombre correcto de la tabla 'vacancies'
                ->join('company', 'vacancies.company_id', '=', 'company.id') // 'company' debe ser 'companies' si esa es la tabla correcta
                ->select('vacancies.*', 'company.name as company_name') // 'company.name' debe ser 'companies.name'
                ->get();
        
        
        

            
    
        return response()->json(["vacancies" => $vacancies]);
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