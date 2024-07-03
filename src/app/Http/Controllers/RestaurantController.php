<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($request->filled('area')) {
            $query->where('area_id',$request->area);
        }

        if ($request->filled('genre')) {
            $query->where('genre_id',$request->genre);
        }

        if ($request->filled('name')) {
            $query->where('name','like','%' . $request->name . '%');
        }

        $restaurants = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index',compact('restaurants','areas','genres'));
    }
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('detail',compact('restaurant'));
    }
}
