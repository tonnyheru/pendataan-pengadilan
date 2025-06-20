<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use App\Models\Submission;
use App\Models\Usulan;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

class DashboardController extends Controller
{
    public function index()
    {
        $statistics = [];
        $statistics['total_usulan'] = Submission::count();
        $statistics['total_usulan_approve'] = Submission::where('status', 2)->count();
        $statistics['total_usulan_reject'] = Submission::where('status', 0)->count();

        $chartData = [
            'labels' => ['Ditolak', 'Disetujui'],
            'series' => [$statistics['total_usulan_reject'], $statistics['total_usulan_approve']],
            'colors' => ['#F5365C', '#2DCE89']
        ];

        return view('pages.dashboard.admin', compact('statistics', 'chartData'));
    }
}
