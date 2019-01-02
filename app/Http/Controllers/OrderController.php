<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use App\Models\ActionInstance;
use App\Models\ActionInstanceStatus;
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
        $offerDetails = ProcessInstance::with('offer')->whereId($request->get('orderId'))->first();

        $addons = '';
        if ($offerDetails && $offerDetails->addon_ids && $offerDetails->addon_ids[0] !='') {
            $addons = Offer::whereId($offerDetails->addon_ids[0])->get();
        }
        $formatter = new Formatter();
        $xml = $formatter->format('<?xml version="1.0" encoding="UTF-8"?>'.$offerDetails->placed_order);
        return compact('orderActionDetails', 'offerDetails', 'addons', 'xml');
    }

    public function update(Request $request)
    {
        ProcessInstance::whereId($request->get('orderId'))->update(['note' => $request->get('orderNote')]);
        return response()->json('true');
    }

    public function orderSearchList(Request $request)
    {
        $orderDetails = ProcessInstance::with('processStatus')->with('process')
                            ->orderSearch($request->get("orderFilterOption"), $request->get("orderField"))
                            ->take(100)->get();
        return $orderDetails;
    }
}
