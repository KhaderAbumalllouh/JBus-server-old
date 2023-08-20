<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityRoutesController extends Controller
{
    // public function returnUniversityRoutes(Request $request)
    // {
    //     $routes = University::where('id', $request->id)
    //         ->with('UniversityRoute.route')
    //         ->get();
    //     return response()->json($routes);
    // }

    public function returnUniversitiesRoutes(Request $request)
    {
        // $universityName = $request->name;

        // $routes = University::where('name', 'like', '%' . $universityName . '%')
        //     ->with('UniversityRoute.route')
        //     ->limit(5)
        //     ->get();
        // return response()->json($routes);
        $id = $request->id;
        $universities = University::with(['universityRoute' => function ($query) use ($id) {
            $query->with(['route.favoritePoints' => function ($query) use ($id) {
                $query->where('id', $id);
        }]);
    }])->get();

        return $universities;
    }
    public function searchUniversitiesRoutes(Request $request)
    {
        $id = $request->id;
        $universities = University::where('name', 'like', '%' . $request->name . '%')->with(['universityRoute' => function ($query) use ($id) {
            $query->with(['route.favoritePoints' => function ($query) use ($id) {
                $query->where('id', $id);
        }]);
    }])->get();

        return $universities;
    }
}