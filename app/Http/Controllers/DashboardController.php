<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage() {
        return view('pages.dashboard.dashboard-page');
    }

    function EmployeeDashboardPage() {
        return view('pages.dashboard.employee-page');
    }
}
