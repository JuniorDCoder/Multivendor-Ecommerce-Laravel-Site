<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductTrackController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('tracker')){
            $order = Order::where('invocie_id', $request->tracker)->first();
    
            return view('frontend.pages.product-track', compact('order'));
        }else {
            return view('frontend.pages.product-track');
        }
    }

}
