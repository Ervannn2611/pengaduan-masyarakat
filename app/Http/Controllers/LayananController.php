<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{


    public function index()
    {
        $reports = Report::all(); // Ambil semua laporan dari database
        return view('dashboard', compact('reports'));
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
        $reports = Report::where('user_id', auth()->id())->get(); // Ambil semua laporan dari database
        return view('reports.detail', compact('reports'));
    }
    public function show($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return redirect()->route('reports.index')->with('error', 'Report not found.');
        }

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
