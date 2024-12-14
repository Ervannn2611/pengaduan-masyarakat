<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function voting($id)
    {
        // Cari data report berdasarkan ID
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not found'
            ], 404);
        }

        // Tambah nilai voting
        $report->increment('voting');

        return response()->json([
            'status' => 'success',
            'message' => 'Like added successfully',
            'voting' => $report->voting
        ]);
    }
}
