<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Package;

use App\Balance;
use App\Site;
use App\Category;
use App\Expense;
use App\Creditor;
use App\Due;
use App\Temppayment;

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

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $packages = Package::where('status', 1)->get();

        return view('index.index')->withPackages($packages);
    }

    public function termsAndConditions()
    {
        return view('index.termsandconditions');
    }

    public function privacyPolicy()
    {
        return view('index.privacypolicy');
    }

    public function refundPolicy()
    {
        return view('index.refundpolicy');
    }

    public function paymentProceed(Request $request)
    {
        $this->validate($request,array(
            'user_number'    =>   'required',
            'package_id'     =>   'required',
            'amount'         =>   'required',
        ));

        $user = User::where('mobile', $request->user_number)->first();

        if($user) {
            $temppayment = new Temppayment;
            $temppayment->user_id = $user->id;
            $temppayment->package_id = $request->package_id;
            $temppayment->uid = $user->uid;
            // generate Trx_id
            $trx_id = 'BJS' . random_string(7);
            $temppayment->trx_id = $trx_id;
        } else {
            Session::flash('warning','নাম্বারটি পাওয়া যায়নি! আগে রেজিস্ট্রেশন করুন।');
            return redirect()->route('index.index');
        }
    }

    public function paymentSuccess()
    {
        Session::flash('info','Payment is cancelled!');
        return view('index.payment.success');
    }

    public function paymentCancel()
    {
        Session::flash('info','Payment is cancelled!');
        return view('index.payment.cancel');
    }

    public function paymentFailed()
    {
        Session::flash('info','Payment is cancelled!');
        return view('index.payment.failed');
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
