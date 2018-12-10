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

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (($request->get('email') == 'poadmin@promon.com' && $request->get('password') == 'test123')) {
            session(['loginsuccess'=>true]);
            return redirect('home');
        } else {
            session(['loginsuccess'=>false]);
            return view('pages.login');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('/');
    }
}
