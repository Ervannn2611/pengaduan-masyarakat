<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Report;
use Illuminate\Http\Request;

class ResponController extends Controller
{
    /**
     * Update the response status based on user actions.
     */
    public function updateStatus(Request $request, $reportId)
    {
        $report = Report::with('responses')->findOrFail($reportId);

        // Validasi input tanggapan
        $status = $request->input('response');
        if (!in_array($status, ['Proses Perbaikan', 'Tidak'])) {
            return redirect()->back()->withErrors(['response' => 'Status tanggapan tidak valid.']);
        }

        // Simpan atau perbarui status tanggapan
        $response = Response::updateOrCreate(
            ['report_id' => $report->id],
            [
                'response_status' => $status === 'Proses Perbaikan' ? 'ON_PROCESS' : 'REJECT',
                'staff_id' => auth()->id(),
            ]
        );
        
        // dd($response);
        return redirect()->route('staff.detail', $report->id)
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Mark the response as DONE.
     */
    public function markAsDone($reportId)
    {
        // Temukan tanggapan berdasarkan ID laporan
        $response = Response::where('report_id', $reportId)->firstOrFail();

        // Perbarui status menjadi "DONE"
        $response->update(['response_status' => 'DONE']);

        return redirect()->route('staff.detail', $reportId)
            ->with('success', 'Tanggapan berhasil dinyatakan selesai.');
    }
}

?>
