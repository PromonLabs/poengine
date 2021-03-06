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
            session(['loginSuccess'=>true]);
            return redirect('api/home');
        } else {
            session(['loginSuccess'=>false]);
            return view('pages.login');
        }
    }

    public function checklogin(Request $request)
    {

        if ($request->session()->exists('loginSuccess')) {
            return redirect('api/home');
        }
        return view('pages/login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('/');
    }
}
