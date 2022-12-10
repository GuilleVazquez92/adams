<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Payment;

class WebhookController extends Controller
{
    public function handle(Request $request)
      {     
       
       $order = $request->debt['docId'];
       $status = $request->debt['payStatus']['status'];

       if ($status == 'paid') {
         $status = 1;
       }elseif ($status == 'pending') {
         $status = 2;
       }else{
        $status = 0;
       }

       Payment::where('order_id', $order)->update(['status' => $status]);
      }
}
