<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    public function getAllCompany()
    {
        $company = Company::all();
        return response()->json(["company" => $company]);
    }

    public function show($id)
    {
        $company = Company::where('id', $id)->get();
        return response($company);
    }
    public function insertCompany(Request $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->mail = $request->mail;
        $company->phone = $request->phone;
        $company->contact = $request->contact;
        $company->logo = $request->logo;
        $company->password = $request->password;
        $company->save();
        return response()->json(['message' => 'Company created successfully', 'company' => $company], 201);
    }
    public function deleteCompany($id)
    {
        $company = Company::where('id', $id)->first();
        if (!$company) {
            return response()->json(["error" => "company not found"]);
        }
        $company->delete();
        return response()->json(["data" => "Company with $id deleted successfully"]);
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::where('id', $id)->first();
        $company->name = $request->name;
        $company->mail = $request->mail;
        $company->phone = $request->phone;
        $company->contact = $request->contact;
        $company->logo = $request->logo;
        $company->password = $request->password;
        $company->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }

}
