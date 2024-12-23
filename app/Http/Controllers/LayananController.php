<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
class LayananController extends Controller
{
    public function search(Request $request)
{
    // $keyword = $request->input('keyword');
    // $province = $request->input('province');

    // $query = Report::query();

    // if ($keyword) {
    //     $query->where('description', 'LIKE', '%' . $keyword . '%');
    // }

    // if ($province && $province !== 'Pilih Provinsi') {
    //     $query->where('province', $province);
    // }

    // $reports = $query->get();

    // return view('reports.index', compact('reports'));
}
public function export()
{
    return Excel::download(new ReportsExport, 'reports.xlsx');
}
public function index(Request $request)
{
    $provinceId = $request->input('province'); // Ambil input 'province'
    if ($provinceId) {
        // Query berdasarkan provinsi
        $reports = \App\Models\Report::where('province', $provinceId)->get();

        // Jika hasil kosong
        if ($reports->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada laporan untuk provinsi ini.');
        }
    } else {
        // Jika tidak ada input province, tampilkan semua data
        $reports = \App\Models\Report::all();
    }

    // Kembalikan data ke view
    return view('dashboard', compact('reports', 'provinceId'));
}




    public function create()
    {
        return view('reports.create'); // Mengarahkan ke halaman create laporan
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'description' => 'required|string|max:500',
        'type' => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
        'province' => 'required|string',
        'regency' => 'required|string',
        'subdistrict' => 'required|string',
        'village' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = null;
    }

    $validatedData['image'] = $imagePath;

    Report::create([
        'user_id' => Auth::user()->id,
        'description' => $validatedData['description'],
        'type' => $validatedData['type'],
        'province' => $validatedData['province'],
        'regency' => $validatedData['regency'],
        'subdistrict' => $validatedData['subdistrict'],
        'village' => $validatedData['village'],
        'image' => $validatedData['image'],
    ]);

    return redirect()->route('reports.detail')->with('success', 'Laporan berhasil dibuat.');
}


    // Method untuk mendapatkan nama provinsi dari API eksternal
    private function getProvinceName($provinceId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
        $provinces = $response->json();

        foreach ($provinces as $province) {
            if ($province['id'] == $provinceId) {
                return $province['name'];
            }
        }

        return 'Unknown Province';
    }

    public function detail()
    {
        $reports = Report::with('responses')->where('user_id', auth()->id())->latest()->get();

        return view('reports.detail', compact('reports'));
    }
    public function show($id)
    {
        $report = Report::findOrFail($id);

        $report->increment('viewers');

        return view('reports.article', compact('report'));
    }


    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        if (Storage::disk('public')->exists("images/{$report->image}")) {
            Storage::disk('public')->delete("images/{$report->image}");
        }
        $report->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }

}
