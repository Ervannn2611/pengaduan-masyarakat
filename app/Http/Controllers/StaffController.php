<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ResponseProgress;
use App\Models\Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('staff.dashboard', compact('reports'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reports = Report::all();
        return view('staff.response', compact('reports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'histories' => 'required|string',
        'response_id' => 'required|exists:responses,id',
    ]);

    // Ambil laporan berdasarkan ID
    $report = Report::findOrFail($id);

    // Buat entri progress baru
    ResponseProgress::create([
        'histories' => $request->input('histories'),
        'response_id' => $request->input('response_id'),
    ]);

    // Redirect ke halaman yang sama agar progress terbaru muncul
    return redirect()->route('staff.detail', $id)->with('success', 'Progress berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('responseProgress')->findOrFail($id);

        if (!$report) {
            return redirect()->route('staff.dashboard')->with('error', 'Laporan tidak ditemukan.');
        }

        return view('staff.response', compact('report'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }

}
