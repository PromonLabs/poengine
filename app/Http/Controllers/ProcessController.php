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
        $processDetails = Process::with('getActions')->orderBy('id', 'asc')->get();
        return $processDetails;
    }

    public function processNameList(Request $request)
    {
        $processNameLists = Process::where('name', 'like', $request->get('processName').'%')->get(['name']);
        $processName  = '';

        foreach ($processNameLists as $processNameList) {
            $processName .= '<option value="'.$processNameList->name.'">'.$processNameList->name.'</option>';
        }
        return $processName;
    }

    public function list(Request $request)
    {
        $processDetails = Process::with('getActions')->where('name', 'ilike', $request->get('processName').'%')->paginate(20);
        return view('pages.process-list', compact('processDetails'));
    }
}
