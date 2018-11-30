<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;
use App\Models\Step;
use DB;

class ProcessController extends Controller
{
    public function index(Request $request)
    {
        $processDetails = Process::with('getActions')->orderBy('id', 'asc')->paginate(20);
        return view('pages.process', compact('processDetails'));
    }
}
