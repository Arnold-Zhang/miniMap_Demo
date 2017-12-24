<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['store']
        ]);
    }

    /*
    	处理城市添加请求
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities|max:20',
            'xaxis' => 'required',
            'yaxis' => 'required'
        ]);
        
        $city = City::create([
            'name' => $request->name,
            'xaxis' => $request->xaxis,
            'yaxis' => $request->yaxis,
        ]);
        session()->flash('success', 'Add City Success!');
        return redirect(route('home'));
    }
}
