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

    public function processEdit(Request $request)
    {
        $processDetails = Process::with('getActions')->where('name', 'like', $request->get('processName'))->get();
        return $processDetails;
    }

    public function list(Request $request)
    {
        $processDetails = Process::with('getActions')->where('name', 'like', $request->get('processName'))->get();
        return view('pages.process-list', compact('processDetails'));
    }
}
