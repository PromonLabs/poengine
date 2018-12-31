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

    public function processSearchList(Request $request)
    {
        $processDetails = Process::with('getActions')
                            ->nameSearch($request->get('processFilter'))
                            ->descriptionSearch($request->get('processFilter'))
                            ->get();
        return $processDetails;
    }

    public function edit(Request $request)
    {
        $processDetails = Process::with('getActions')->where('name', 'like', $request->get('processName'))->get();
        return $processDetails;
    }

    public function list(Request $request)
    {
        $processDetails = Process::with('getActions')->where('name', 'like', $request->get('processName'))->get();
        return view('pages.process-list', compact('processDetails'));
    }

    public function update(Request $request)
    {
        Process::whereId($request->get('processId'))->update(['name' => $request->get('processName'), 'description' => $request->get('processDescription'), 'priority' => $request->get('processPriority'), 'xsd_filename' => $request->get('processXsd'), 'callback_num_required' => $request->get('processCallback')]);
        return response()->json('true');
    }
}
