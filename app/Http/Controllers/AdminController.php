<?php

namespace App\Http\Controllers;

use App\KunjunganHarian;
use App\PendaftaranMembership;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $total_member = PendaftaranMembership::select('*');
        if ($month = $request->month) {
            $total_member = $total_member->whereMonth('created_at', $month);
        }
        if ($year = $request->year) {
            $total_member = $total_member->whereYear('created_at', $year);
        }
        $total_member = number_format($total_member->count());

        $total_harian = KunjunganHarian::select('*');
        if ($month = $request->month) {
            $total_harian = $total_harian->whereMonth('created_at', $month);
        }
        if ($year = $request->year) {
            $total_harian = $total_harian->whereYear('created_at', $year);
        }
        $total_pendapatan_harian = "Rp. " . number_format($total_harian->sum('total'));
        $total_harian = number_format($total_harian->count());


        return view('admin.index', compact('total_member', 'total_harian', 'total_pendapatan_harian'));
    }
}
