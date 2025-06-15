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
            'total_loans' => loan::where('status', 'waiting for respond')->count(),
            'total_returns' => return_item::count(),
            'total_items' => item_master::count(),
        ]);
    }

    public function analytic($date)
    {
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));

        // Per tahun (5 tahun terakhir)
        $startYear = $year - 4;
        $yearLabels = [];
        $yearLoans = [];
        $yearReturns = [];
        $yearItems = [];
        for ($y = $startYear; $y <= $year; $y++) {
            $yearLabels[] = (string)$y;
            $yearLoans[] = loan::whereYear('created_at', $y)->count();
            $yearReturns[] = return_item::whereYear('created_at', $y)->count();
            $yearItems[] = item_master::whereYear('created_at', $y)->count();
        }

        // Per bulan (12 bulan di tahun ini)
        $monthLabels = [];
        $monthLoans = [];
        $monthReturns = [];
        $monthItems = [];
        for ($m = 1; $m <= 12; $m++) {
            $label = date('F', mktime(0, 0, 0, $m, 10));
            $monthLabels[] = $label;
            $monthLoans[] = loan::whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
            $monthReturns[] = return_item::whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
            $monthItems[] = item_master::whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
        }

        // Per hari (tanggal di bulan ini)
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dayLabels = [];
        $dayLoans = [];
        $dayReturns = [];
        $dayItems = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $label = sprintf('%02d', $d);
            $dayLabels[] = $label;
            $dateStr = "$year-$month-$label";
            $dayLoans[] = loan::whereDate('created_at', $dateStr)->count();
            $dayReturns[] = return_item::whereDate('created_at', $dateStr)->count();
            $dayItems[] = item_master::whereDate('created_at', $dateStr)->count();
        }

        return response()->json([
            'per_year' => [
                'labels' => $yearLabels,
                'loans' => $yearLoans,
                'returns' => $yearReturns,
                'items' => $yearItems,
            ],
            'per_month' => [
                'labels' => $monthLabels,
                'loans' => $monthLoans,
                'returns' => $monthReturns,
                'items' => $monthItems,
            ],
            'per_day' => [
                'labels' => $dayLabels,
                'loans' => $dayLoans,
                'returns' => $dayReturns,
                'items' => $dayItems,
            ],
        ]);
    }
}
