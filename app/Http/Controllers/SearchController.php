<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('term');
        $results = YourModel::where('column', 'LIKE', '%' . $searchTerm . '%')->get();
        return response()->json($results);
    }
}
