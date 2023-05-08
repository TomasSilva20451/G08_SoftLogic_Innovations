<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $data = DB::table('customers')->get();
        return response()->json($data);
    }
}

