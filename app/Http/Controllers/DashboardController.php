<?php

namespace App\Http\Controllers;

use App\Models\item_master;
use App\Models\loan;
use App\Models\return_item;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_loans' => loan::where('approved', 'waiting for approval')->count(),
            'total_returns' => return_item::where()->count(),
            'total_items' => item_master::count(),
        ]);
    }
}
