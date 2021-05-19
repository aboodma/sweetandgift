<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PurchaseHistoryCollection;
use App\Models\Order;
use App\Models\Customer;

class PurchaseHistoryController extends Controller
{
    public function index($id)
    {
      header('Access-Control-Allow-Origin', '*');
      header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
      // $user = Customer::where('trend_customer_id',$id)->first();
        return new PurchaseHistoryCollection(Order::where('trend_customer_id', $id)->latest()->get());
    }
}
