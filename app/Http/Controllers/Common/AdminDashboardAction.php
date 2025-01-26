<?php

namespace App\Http\Controllers\Common;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardAction extends Controller
{
    public function index()
    {
        return view('common.dashboard');
    }
    public function getcities($id)
    {
        $cities = City::where('country_id',$id)->latest()->get();
        return response()->json($cities);
    }
}
