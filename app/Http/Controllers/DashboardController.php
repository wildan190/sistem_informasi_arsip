<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {

        // count berdasarkan user
        $userCount = User::count();

        // count berdasarkan bulan
        $bulanIni = date('m');
        $tahunIni = date('Y');
        $bulanIniCount = Arsip::whereMonth('created_at', $bulanIni)->whereYear('created_at', $tahunIni)->count();

        // count berdasarkan tahun
        $tahunIniCount = Arsip::whereYear('created_at', $tahunIni)->count();

        return view('cms.pages.dashboard', compact('bulanIniCount', 'tahunIniCount', 'userCount'));
    }
}
