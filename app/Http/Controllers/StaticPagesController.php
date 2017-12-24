<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Road;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        $citiesName = City::pluck('name')->toArray();
        $xaxis = City::pluck('xaxis')->toArray();
        $yaxis = City::pluck('yaxis')->toArray();
        $param = [
            'citiesName'   =>  $citiesName,
            'xaxis' => $xaxis,
            'yaxis' => $yaxis,
        ];
        return view('index', $param);
    }
}
