<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Road;
use Illuminate\Http\Request;

class RoadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['store']
        ]);
    }

    /*
    	处理道路添加请求
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nameA' => 'required',
            'nameB' => 'required'
        ]);

        $road = new Road();
        $cityA = City::where('name', $request->nameA)->first();
        $cityB = City::where('name', $request->nameB)->first();

        $cityARoads = $cityA->roads;
        $cityBRoads = $cityB->roads;

        $cityARoadIds = [];
        $cityBRoadIds = [];
        foreach ($cityARoads as $cityARoad) {
            $cityARoadIds[] = $cityARoad->id;
        }
        foreach ($cityBRoads as $cityBRoad) {
            $cityBRoadIds[] = $cityBRoad->id;
        }

        // 若道路已经存在
        if (array_intersect($cityARoadIds, $cityBRoadIds)) {
            session()->flash('danger', 'This Road is exist!');
            return redirect(route('home'));
        }

        $road->distance = sqrt(pow(abs($cityA->xaxis - $cityB->xaxis), 2) + pow(abs($cityA->yaxis - $cityB->yaxis), 2));
        $road->save();

        session()->flash('success', 'Add Road Success!');
        return redirect(route('home'));
    }
}
