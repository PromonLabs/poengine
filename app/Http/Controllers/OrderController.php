<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use App\Models\ActionInstance;
use App\Models\offer;
use PrettyXml\Formatter;

class OrderController extends Controller
{
    public function orderList(Request $request)
    {
        $orderDetails = ProcessInstance::with('processStatus')->with('process')->orderBy('id', 'desc')->take(100)->get();
        return $orderDetails;
    }

    public function flow(Request $request)
    {
        $orderActionDetails = ActionInstance::with('actionStatus')->with('action')->whereProcessInstanceId($request->get('orderId'))->orderBy('step', 'asc')->get();
        $offerDetails = ProcessInstance::with('offer')->whereId($request->get('orderId'))->get();

        $addons = '';
        if ($offerDetails && $offerDetails[0]->addon_ids && $offerDetails[0]->addon_ids[0] !='') {
            $addons = Offer::whereId($offerDetails[0]->addon_ids[0])->get();
        }
        $formatter = new Formatter();
        $xml = $formatter->format('<?xml version="1.0" encoding="UTF-8"?>'.$offerDetails[0]->placed_order);
        return view('pages.order-flow', compact('orderActionDetails', 'offerDetails', 'addons', 'xml'));
    }

    public function update(Request $request)
    {
        ProcessInstance::whereId($request->get('orderId'))->update(['note' => $request->get('orderNote')]);
        return response()->json('true');
    }

    public function orderSearchList(Request $request)
    {
        $orderDetails = ProcessInstance::with('processStatus')->with('process')->where('id', 'like', strval($request->get('orderField')).'%')->orWhere('id', $request->get('orderField'))->get();
        return $orderDetails;
    }
}
