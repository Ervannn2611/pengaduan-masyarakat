<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function vote(Request $request, $id)
    {
        // Cari report berdasarkan ID, jika tidak ada, akan error 404
        $report = Report::findOrFail($id);

        // Mendapatkan user ID yang sedang login
        $userId = auth()->id();

        // Decode voting menjadi array, jika null, gunakan array kosong
        $votes = json_decode($report->voting ?? '[]', true);
        if (!is_array($votes)) {
            $votes = []; // Default ke array kosong jika decoding gagal
        }

        // Periksa apakah user sudah voting
        if (in_array($userId, $votes)) {
            // Hapus user dari daftar voting jika sudah vote sebelumnya
            $votes = array_diff($votes, [$userId]);
        } else {
            // Tambahkan user ke daftar voting
            $votes[] = $userId;
        }

        // Simpan perubahan voting sebagai JSON
        $report->voting = json_encode(array_values($votes));

        // Pastikan kolom lain seperti description tidak null
        if (!$report->description) {
            $report->description = 'Default description'; // Ganti sesuai kebutuhan
        }

        // Hitung jumlah vote
        $voteCount = count($votes); // Menghitung jumlah vote

        // Simpan data ke database
        $report->save();

        // Redirect kembali dengan pesan sukses dan jumlah vote
        return redirect()->back()->with($voteCount);
    }
}
