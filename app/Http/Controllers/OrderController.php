<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use App\Models\ActionInstance;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $orderDetails = ProcessInstance::with('processStatus')->with('process')->whereId($request->get('orderId'))->get();
        return view('pages.order-list', compact('orderDetails'));
    }

    public function flow(Request $request)
    {
        $orderActionDetails = ActionInstance::with('actionStatus')->with('action')->whereProcessInstanceId($request->get('orderId'))->orderBy('step', 'asc')->get();
        $offerDetails = ProcessInstance::with('offer')->with('addOns')->whereId($request->get('orderId'))->get();
        return view('pages.order-flow', compact('orderActionDetails', 'offerDetails'));
    }
}
