<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // total sels ammount
    public function totalPaid(Request $request){
        $user_id = $request->header('id');
        $totalPaid = Invoice::where('user_id',$user_id)->sum('payable');
        return response()->json(['totalPaid' => $totalPaid],200);
    }


    public function totalOrder(Request $request){
        $user_id = $request->header('id');
        $totalOrder = Invoice::where('user_id',$user_id)->count();
        return response()->json(['totalOrder' => $totalOrder],200);
    }

    public function recentOrder(Request $request){
        $user_id = $request->header('id');
        $recentOrder = Invoice::where('user_id',$user_id)->with('customer')->orderBy('id','desc')->take(5)->get();
        return response()->json(['recentOrder' => $recentOrder],200);
    }
}
