<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil hanya data yang memiliki status 'approved'
        return Report::select([
            'id',           // ID atau nomor
            'created_at',   // Tanggal dibuat
            'description',  // Deskripsi laporan
            'image',        // Gambar
            'province',     // Provinsi
            'regency',      // Kabupaten/Kota
            'subdistrict',  // Kecamatan
            'village',      // Desa/Kelurahan
            'voting'        // Voting
        ])
          ->orderBy('created_at', 'asc')
          ->get();
    }

    /**
     * Menentukan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            "No",
            "Created At",
            "Description",
            "Image",        // Gambar
            "Province",     // Provinsi
            "Regency",      // Kabupaten/Kota
            "Subdistrict",  // Kecamatan
            "Village",      // Desa/Kelurahan
            "Voting"        // Voting
        ];
    }
}
