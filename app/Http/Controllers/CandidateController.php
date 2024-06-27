<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
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

    public function getAllCandidates()
    {
        $Candidates = Candidate::all();
        return response()->json(["Candidates" => $Candidates]);
    }

    public function showCandidates($id)
    {
        $Candidates = Candidate::where('id', $id)->get();
        return response($Candidates);
    }
    public function insertCandidates(Request $request)
    {
        $Candidates = new Candidate();
        $Candidates->name = $request->name;
        $Candidates->phone = $request->phone;
        $Candidates->email = $request->email;
        $Candidates->address = $request->address;
        $Candidates->save();
        return response()->json(['message' => 'Candidate created successfully', 'Candidates' => $Candidates], 201);
    }
    public function deleteCandidates($id)
    {
        $Candidates = Candidate::where('id', $id)->first();
        if (!$Candidates) {
            return response()->json(["error" => "Candidate not found"]);
        }
        $Candidates->delete();
        return response()->json(["data" => "Candidate $id deleted successfully"]);
    }

    public function updateCandidates(Request $request, $id)
    {
        $Candidates = Candidate::where('id', $id)->first();
        $Candidates->name = $request->name;
        $Candidates->phone = $request->phone;
        $Candidates->email = $request->email;
        $Candidates->address = $request->address;
        $Candidates->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }
}
