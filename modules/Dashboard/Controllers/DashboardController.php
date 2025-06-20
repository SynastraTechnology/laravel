<?php

namespace Modules\Dashboard\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class DashboardController extends Controller{
     public function index(): View
    {
        return view('dashboard::index'); 
    }
}