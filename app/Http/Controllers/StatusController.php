<?php

namespace App\Http\Controllers;

use App\Models\Status;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;

class StatusController extends Controller
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

    public function getAllStatus()
    {
        $status = Status::all();
        return response()->json(["Status" => $status]);
    }

    public function showStatus($id)
    {
        $status = Status::where('id', $id)->first();
        return response($status);
    }

}
