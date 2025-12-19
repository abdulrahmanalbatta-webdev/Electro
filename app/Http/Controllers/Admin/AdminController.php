<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;

class AdminController extends Controller
{
    function payments()
    {
        $payments = Payment::oldest()->paginate(10);
        return view('backend.payments', compact('payments'));
    }

    function notifications()
    {
        return view('backend.notifications');
    }
}
