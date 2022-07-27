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
use Shipu\Aamarpay\Facades\Aamarpay;


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
        $package = Package::findOrFail($request->package_id);

        if($user) {
            $temppayment = new Temppayment;
            $temppayment->user_id = $user->id;
            $temppayment->package_id = $request->package_id;
            $temppayment->uid = $user->uid;
            // generate Trx_id
            $trx_id = 'BJS' . random_string(10);
            $temppayment->trx_id = $trx_id;
            $temppayment->amount = $request->amount;
            $temppayment->save();

            Session::flash('info','পেমেন্টটি সম্পন্ন করুন!');
            return view('index.payments.paynow')
                            ->withUser($user)
                            ->withAmount($request->amount)
                            ->withPackagedesc($package->name . ' - ' . $package->duration . ' - ৳ ' . $package->price)
                            ->withTrxid($trx_id);
        } else {
            Session::flash('warning','নাম্বারটি পাওয়া যায়নি! আগে রেজিস্ট্রেশন করুন।');
            return redirect()->route('index.index');
        }
    }

    public function paymentSuccess(Request $request)
    {
        // dd($request->all());
        $user_id = $request->get('opt_a');
        
        if($request->get('pay_status') == 'Failed') {
            Session::flash('info', 'পেমেন্ট সম্পন্ন হয়নি, আবার চেষ্টা করুন!');
            return redirect()->route('index.index');
        }
        
        $amount_request = $request->get('opt_b');
        $amount_paid = $request->get('amount');

        // if($amount_paid == $amount_request) {
           // OLD VERIFICATION METHOD... 
        // }
        $valid  = Aamarpay::valid($request, $amount_request);
        if($valid) {
            // Successfully Paid.
        } else {
           // Something went wrong. 
        }
    }

    public function paymentCancel(Request $request)
    {
        Session::flash('info','পেমেন্টটি ক্যানসেল করা হয়েছে!');
        return redirect()->route('index.index');
    }

    public function paymentFailed(Request $request)
    {
        Session::flash('info','পেমেন্টটি ব্যর্থ হয়েছে! অনুগ্রহ করে যোগাযোগ করুন।');
        return view('index.payments.failed');
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
