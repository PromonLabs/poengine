<?php

namespace App\Http\Controllers\Api\Webhook;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Entities\GraphEntity;
use Log;

class Graph extends Controller
{
    private $client;
    private $data;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function showGraph()
    {
        //$this->data = $this->client->get('http://centnuk19:9090/api/v1/query?query=prometheus_http_request_duration_seconds_count')->getBody();
        // $this->data = $this->client->get('http://centnuk19:9090/api/v1/query_range?query=http_server_requests_seconds_count{job=%22ComverseQueryService%22,instance=%22tusass-microservices02:8081%22}&start=1532995673&end=1533017273&step=20')->getBody();
        $this->data = $this->client->get('http://centnuk19:9090/api/v1/query_range?query=jvm_threads_live{instance=%22tusass-microservices02:8081%22,job=%22ComverseQueryService%22}&start=1532995673&end=1533017273&step=20')->getBody();
        //dd(json_decode($this->data));
        $response = json_decode($this->data);
        $result = $response->data->result;
        //return new GraphEntity(collect($response->data()));
        return(view('pages.graph', compact('result')));
    }

}