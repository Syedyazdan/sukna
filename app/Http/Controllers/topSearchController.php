<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\top_search;

class topSearchController extends Controller
{
    public function top_search(Request $request)
    {


        $newdata = new top_search;

        $newdata->keywords = $request->k;

        $newdata->save();
    }
}
