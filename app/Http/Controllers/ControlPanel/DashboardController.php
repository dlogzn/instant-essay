<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $title = 'Dashboard';
        $activeNav = 'Dashboard';
        return response()->view('ControlPanel.dashboard', compact('title', 'activeNav'), Response::HTTP_OK);
    }
}
