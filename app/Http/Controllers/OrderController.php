<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use App\Models\ActionInstance;
use App\Models\offer;

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
        $offerDetails = ProcessInstance::with('offer')->whereId($request->get('orderId'))->get();

        if ($offerDetails && $offerDetails[0]->addon_ids) {
            $addons = Offer::whereId($offerDetails[0]->addon_ids[0])->get();
        }
        return view('pages.order-flow', compact('orderActionDetails', 'offerDetails', 'addons'));
    }
}
