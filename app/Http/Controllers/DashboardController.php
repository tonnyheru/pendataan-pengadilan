<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.admin');
    }
}
