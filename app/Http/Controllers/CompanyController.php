<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    public function getAllCompany(Request $request)
    {
        $authenticatedCompany = auth()->user();

        if (!$authenticatedCompany) {
            return response()->json(['error' => 'No autorizado'], 401);
        }
        $query = Company::select('id', 'name', 'mail', 'phone', 'contact', 'logo', 'password')
            ->where('company.activo', true);
        if ($authenticatedCompany->mail === 'techpech@protonmail.mx') {
            $companies = $query->get();
        } else {
            $companies = $query->where('id', $authenticatedCompany->id)->get();
        }

        return response()->json(['companies' => $companies]);
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
        $company->activo = true;
        $company->save();

        return response()->json(['message' => 'Company created successfully', 'company' => $company], 201);
    }

    public function deleteCompany($id)
    {
        $company = Company::where('id', $id)->first();
        if (!$company) {
            return response()->json(["error" => "Company not found"]);
        }
        
        $company->activo = false;
        $company->save();

        return response()->json(["message" => "Company with id $id hidden successfully"]);
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
