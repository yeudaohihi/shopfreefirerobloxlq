<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
  {

    $stats = [];

    return view('staff.dashboard', compact('stats'));
  }
}
