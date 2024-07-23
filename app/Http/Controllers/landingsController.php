<?php

namespace App\Http\Controllers;

use App\Models\landings;
use Illuminate\Http\Request;

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

    public function getAlllandings()
    {
        $landings = landings::all();
        return response()->json(["landings" => $landings]);
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
        $landings = landings::where('id', $id)->first();
        $landings->slugs = $request->slugs;
        $landings->logo = $request->logo;
        $landings->hero = $request->hero;
        $landings->services = $request->services;
        $landings->packages = $request->packages;
        $landings->company_id = $request->company_id;
        $landings->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }
}
