<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
 * index Config
 * @param  Request   $request   Array data
 * @param  [String]  $name      name route
 * @return [String]           url base app
 */
    public function index(Request $request, $name)
    {
        return route($name, $request->all());
    }
}
