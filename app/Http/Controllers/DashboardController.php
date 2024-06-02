<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $visitorPerMonth = Visitor::select(
            DB::raw("(count(id)) as total"),
            DB::raw("(DATE_FORMAT(date, '%M')) as month")
        )
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("DATE_FORMAT(date, '%m')"))
            ->get()->keyBy('month');

        $date = date('Y-m-d');
        $not_exit = Visitor::where('is_exit', 1)->count();
        $today_visitor = Visitor::where('date', $date)->count();
        $total_visitor = Visitor::count();
        return view('dashboard', compact('not_exit', 'today_visitor', 'total_visitor', 'visitorPerMonth'));
    }
}
