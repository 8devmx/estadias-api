<?php

namespace App\Http\Controllers;

use App\Models\landings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;

class landingsController extends Controller
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

    // public function getAlllandings()
    // {
    //     // $landings = landings::all();
    //     $landings = Landings::select('landings.id', 'landings.logo', 'landings.slugs', 'landings.hero', 'landings.company_id', 'landings.services', 'landings.packages', 'company.name')
    //     ->leftjoin('company', 'landings.company_id', '=', 'company.id')
    //     ->get();
    //     return response()->json(["landings" => $landings]);
    // }


        public function getAllLandings(Request $request)
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
            $landings = Landings::select('landings.id', 'landings.logo', 'landings.slugs', 'landings.hero', 'landings.company_id', 'landings.services', 'landings.packages', 'company.name')
                ->leftJoin('company', 'landings.company_id', '=', 'company.id')
                ->get();
        } else {
            // De lo contrario, obtiene solo los registros de la empresa autenticada
            $landings = Landings::select('landings.id', 'landings.logo', 'landings.slugs', 'landings.hero', 'landings.company_id', 'landings.services', 'landings.packages', 'company.name')
                ->leftJoin('company', 'landings.company_id', '=', 'company.id')
                ->where('landings.company_id', $authenticatedCompany->id)
                ->get();
        }

        return response()->json(['landings' => $landings]);
    }

    public function showlandings($id)
    {
        $landings = landings::where('id', $id)->first();
        return response($landings);
    }
    public function showlandingsBySlug($slug)
    {
        $landing = landings::where('slugs', $slug)->first();
    
        if ($landing) {
            return response()->json($landing);
        } else {
            return response()->json(['message' => 'Landing not found'], 404);
        }
    }
    public function insertlandings(Request $request)
    {
        $landings = new landings();
        $landings->slugs = $request->slugs;
        $landings->logo = $request->logo;
        $landings->hero = $request->hero;
        $landings->services = $request->services;
        $landings->packages = $request->packages;
        $landings->company_id = $request->company_id;
        $landings->save();
    }
    public function deletelandings($id)
    {
        $landings = landings::where('id', $id)->first();
        if (!$landings) {
            return response()->json(["error" => "landings not found"]);
        }
        $landings->delete();
        return response()->json(["data" => "landing with id $id deleted successfully"]);
    }
    public function updatelandings(Request $request, $id)
{  
    $landings = Landings::find($id);

    if (!$landings) {
        return response()->json(['error' => 'Landing not found'], 404);
    }

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(env('FRONTEND_PUBLIC_PATH'), $filename);
        $landings->logo = $filename;
    } elseif ($request->has('logo')) {
        $landings->logo = $request->input('logo');
    }

    if ($request->has('hero')) {
        $hero = json_decode($request->input('hero'), true);
        
        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(env('FRONTEND_PUBLIC_PATH'), $filename);
            $hero['background'] = $filename;
        }
        
        $landings->hero = json_encode($hero);
    }

    if ($request->has('company_id')) {
        $landings->company_id = $request->input('company_id');
    }

    $landings->save();

    return response()->json(['data' => 'Se actualizó correctamente', 'landing' => $landings]);
}
}
