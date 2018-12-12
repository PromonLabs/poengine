<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessInstance;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Cache;
use Carbon\Carbon;
use DB;
use Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
            $orderCount = ProcessInstance::count();
            $completedOrderCount = ProcessInstance::whereProcessInstanceStatusId('5')->count();
            $processingOrderCount = ProcessInstance::whereProcessInstanceStatusId('3')->count();
            $failedOrderCount = ProcessInstance::whereProcessInstanceStatusId('4')->count();

            // Get all the order status
            $orderStatus = Cache::remember('orderStatus', 15, function () {
                return DB::select(\DB::raw("Select b.name as name, count(a.*) as count from process_instance a inner join process_instance_status b on a.step = b.id group by b.name"));
            });
            $orderStatus = collect($orderStatus);

            $total = $orderStatus->sum('count');

            // Map RcBatch to a valid representation
            foreach ($orderStatus as $key => $value) {
                $orderStatus[$key]->percentage = round($value->count / $total * 100, 2);
            }

            // Map and remove unused values.
            $orderStatus->each(function ($item, $key) {
                //$item->date = Carbon::createFromFormat("Y-m-d H:i:s", $item->date)->format('Y-m');
                $item->label = $item->name . " " . $item->percentage . "%";
                $item->value = $item->count;
                unset($item->name);
                unset($item->count);
                unset($item->percentage);
            });

            $orderSatusYearsToShow = DB::select(DB::raw("SELECT date_trunc('year', created) AS date FROM process_instance
            GROUP BY 1 ORDER BY 1 asc"));
            $orderSatusYearsToShow = collect($orderSatusYearsToShow);
            $orderSatusYearsToShow->each(function ($item, $key) {
                $item->date = \Carbon\Carbon::parse($item->date)->format('Y');
            });

            foreach ($orderSatusYearsToShow as $orderSatusYears) {
                $ordersStatusGroupByYear[] = DB::select(DB::raw("SELECT date_part('year', created) AS date, (select count(*) FROM process_instance where process_instance_status_id IN ('5') and date_part('year', created) IN ($orderSatusYears->date)) AS completedorders, (select count(*) FROM process_instance where process_instance_status_id IN ( '4') and date_part('year', created) IN ($orderSatusYears->date)) AS failedorders, (select count(*) FROM process_instance where process_instance_status_id IN ('3') and date_part('year', created) IN ($orderSatusYears->date)) AS processingorders, (select count(*) FROM process_instance where process_instance_status_id IN ('2') and date_part('year', created) IN ($orderSatusYears->date)) AS waitingorders, (select count(*) FROM process_instance where process_instance_status_id IN ('1') and date_part('year', created) IN ($orderSatusYears->date)) AS pendingorders, (select count(*) FROM process_instance where process_instance_status_id IN ('6') and date_part('year', created) IN ($orderSatusYears->date)) AS completewithfailureorders, (select count(*) FROM process_instance where process_instance_status_id IN ('7') and date_part('year', created) IN ($orderSatusYears->date)) AS cancelled FROM process_instance where process_instance_status_id IN ('1', '2', '3', '4', '5', '6', '7') and date_part('year', created) = ".$orderSatusYears->date."
                    GROUP BY 1 ORDER BY 1 desc"));
            }
            $singleArray = array();

            foreach ($ordersStatusGroupByYear as $key => $value) {
                $singleArray[$key] = $value[0];
            }
            $ordersStatusGroupByYear = collect($singleArray);

            // Gather all orders grouped by day.
            $ordersGroupByDayData = Cache::remember('ordersGroupByDay', 10, function () {
                return DB::select(DB::raw("SELECT date_trunc('day', created) AS date , count(*) AS orders
                    FROM process_instance GROUP BY 1 ORDER BY 1 DESC limit 40"));
            });

            $ordersCompletedGroupByDayData = Cache::remember('ordersCompletedGroupByDay', 10, function () {
                return DB::select(DB::raw("SELECT date_trunc('day', created) AS date , count(*) AS orders
                    FROM process_instance where process_instance_status_id = '5' GROUP BY 1 ORDER BY 1 DESC limit 40"));
            });

            // Get orders by day
            $ordersGroupByDay = collect($ordersGroupByDayData);
            $ordersCompletedGroupByDay = collect($ordersCompletedGroupByDayData);

            // Add date property to data
            $ordersGroupByDay->each(function ($item, $key) {
                $item->date = \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });
            // Add date property to data
            $ordersCompletedGroupByDay->each(function ($item, $key) {
                $item->date = \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });

            $ordersCompletedGroupByMonthData = Cache::remember('ordersCompletedGroupByMonth', 10, function () {
                return DB::select(DB::raw("SELECT date_trunc('month', created) AS date , count(*) AS orders
                    FROM process_instance where process_instance_status_id = '5' GROUP BY 1 ORDER BY 1 ASC limit 12"));
            });

            $ordersCompletedGroupByMonth = collect($ordersCompletedGroupByMonthData);

            // Add date property to data
            $ordersCompletedGroupByMonth->each(function ($item, $key) {
                $item->date = \Carbon\Carbon::parse($item->date)->format('Y-m');
            });

            return view('pages.home', compact('orderCount', 'completedOrderCount', 'processingOrderCount', 'failedOrderCount', 'ordersGroupByDay', 'ordersCompletedGroupByDay', 'orderStatus', 'ordersStatusGroupByYear', 'ordersCompletedGroupByMonth'));
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
