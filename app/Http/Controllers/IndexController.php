<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Balance;
use App\Site;
use App\Category;
use App\Expense;
use App\Creditor;
use App\Due;

use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
// use Redirect;
use OneSignal;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if user is a manager, redirect him to his profile
        // if user is a manager, redirect him to his profile
        if(Auth::user()->role != 'admin' && Auth::user()->role != 'accountant') {
            return redirect()->route('dashboard.users.single', Auth::user()->id);
        } elseif (Auth::user()->role == 'accountant') {
            return redirect()->route('dashboard.balance');
        }

        $totalsites = Site::count();
        $totalusers = User::count();

        $totalbalance = Balance::sum('amount');
        $totalexpense = Expense::sum('amount');

        $todaystotalexpense = DB::table('expenses')
                                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at"), DB::raw('SUM(amount) as totalamount'))
                                ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), "=", Carbon::now()->format('Y-m-d'))
                                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                                ->first();
        $todaystotaldeposit = DB::table('balances')
                                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at"), DB::raw('SUM(amount) as totalamount'))
                                ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), "=", Carbon::now()->format('Y-m-d'))
                                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                                ->first();

        return view('dashboard')
                    ->withTotalsites($totalsites)
                    ->withTotalusers($totalusers)
                    ->withTotalbalance($totalbalance)
                    ->withTotalexpense($totalexpense)
                    ->withTodaystotalexpense($todaystotalexpense)
                    ->withTodaystotaldeposit($todaystotaldeposit);
    }

    // clear configs, routes and serve
    public function clear()
    {
        Artisan::call('route:clear');
        // Artisan::call('optimize');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('key:generate');
        Artisan::call('config:clear');
        Session::flush();
        return 'Config and Route Cached. All Cache Cleared';
    }
}
