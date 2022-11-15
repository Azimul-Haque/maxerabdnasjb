<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Message;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() 
    {
      $unresolvedmessagecount = Message::where('status', 0)->count();

        

      View::share('sharedbasicinfo', $sharedbasicinfo);
      View::share('notifpendingapplications', $notifpendingapplications);
    }
}
