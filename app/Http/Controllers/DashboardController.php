<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use App\Models\Usulan;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

class DashboardController extends Controller
{
    public function index()
    {
        $statistics = [];
        $statistics['total_usulan'] = Usulan::count();
        $statistics['total_usulan_approve'] = Usulan::where('is_approve', 2)->count();
        $statistics['total_usulan_reject'] = Usulan::where('is_approve', 0)->count();

        $chartData = [
            'labels' => ['Ditolak', 'Disetujui'],
            'series' => [$statistics['total_usulan_reject'], $statistics['total_usulan_approve']],
            'colors' => ['#F5365C', '#2DCE89']
        ];

        return view('emails.notifiedpemohon');
        return view('pages.dashboard.admin', compact('statistics', 'chartData'));
    }
}
