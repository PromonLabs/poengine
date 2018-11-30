<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $orderDetails = ProcessInstance::with('orderStatus')->with('process')->whereId($request->get('orderId'))->get();
        return view('pages.order-list', compact('orderDetails'));
    }

    public function flow(Request $request)
    {
        //$orderDetails = ProcessInstance::with('orderStatus')->with('process')->whereId($request->get('orderId'))->get();
        return view('pages.order-flow');
    }
}
