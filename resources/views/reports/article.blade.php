@extends('layouts.layout')
@section('title', 'Report')
@section('content')
<div class="bg-gray-100 min-h-screen font-poppins">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-md mt-4 max-w-3xl mx-auto" role="alert">
        {{ session('success') }}
        <span class="absolute top-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 01-1.415 0L10 11.414l-2.933 2.933a1 1 0 01-1.414-1.415L8.586 10 5.653 7.067a1 1 0 011.414-1.415L10 8.586l2.933-2.933a1 1 0 011.415 1.415L11.414 10l2.933 2.933a1 1 0 010 1.415z"/></svg>
        </span>
    </div>
    @endif
    <div class="container mx-auto bg-white rounded-lg shadow-lg mt-8 overflow-hidden">
        <div class="bg-orange-600 p-8">
            <h2 class="text-3xl font-semibold text-gray">Kesenjangan Sosial</h2>
        </div>

        @if ($report)
        <div class="p-4 space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">{{ $report->created_at->format('d F Y') }}</h2>
            <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
            <button class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600">{{ $report->type }}</button>

            <div class="mt-6 text-center">
                <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Kesenjangan Sosial" class="rounded-lg shadow-lg inline-block max-w-full sm:max-w-xs">
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
                <p class="font-semibold mb-3">Informasi Pembuatan Pengaduan:</p>
                <ol class="list-decimal pl-5 space-y-1 text-gray-700">
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNGJAWABKAN</strong>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 jam.</li>
                    <li>Periksa tanggapan Kami pada <strong>Dashboard</strong> setelah Anda Login.</li>
                    <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#" class="text-orange-500 underline">Ikuti Tautan</a>.</li>
                </ol>
            </div>
        </div>

        <!-- Simplified Comment Section -->
        <div class="p-6 bg-gray-50 border-t border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Komentar</h3>

            <form class="space-y-4" action="{{ route('reports.comen') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <textarea name="comment" rows="4" placeholder="Tulis komentar Anda..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent" required></textarea>
                <button type="submit" class="w-full py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition-all">Buat Komentar</button>
            </form>

            <!-- Loop through comments, keep it simple -->
            @foreach ($report->comments as $comment)
                <p class="font-medium text-gray-800">{{ $comment->user->email }}</p>
                <p class="mt-2 text-gray-700">{{ $comment->comment }}</p>
                <p class="text-gray-500 text-sm">{{ $comment->created_at->format('d F Y, H:i') }}</p>
                <hr>
            @endforeach

        </div>
        @else
        <p class="p-6 text-gray-700">Pengaduan tidak ditemukan.</p>
        @endif
    </div>
</div>
@endsection
