<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use App\Models\ActionInstance;
use App\Models\offer;
use PrettyXml\Formatter;

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
        $formatter = new Formatter();
        $xml = $formatter->format('<?xml version="1.0" encoding="UTF-8"?>'.$offerDetails[0]->placed_order);
        return view('pages.order-flow', compact('orderActionDetails', 'offerDetails', 'addons', 'xml'));
    }
}
