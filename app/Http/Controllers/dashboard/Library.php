<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Library extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboard-library');
  }
}
