@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Section -->
        <div class="md:col-span-2">
            <form action="{{ route('reports.dashboard') }}" method="GET" class="w-full">
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <select name="province" id="provinsi" class="w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Provinsi</option>
                        <!-- Provinsi akan dimuat di sini oleh JavaScript -->
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                </div>
            </form>

            @if ($reports->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($reports as $report)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Pengaduan" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h5 class="text-lg font-bold text-blue-600 mb-2 truncate">
                                    <a href="{{ route('reports.show', $report->id) }}">{{ $report->description }}</a>
                                </h5>
                                <p class="text-gray-600 text-sm">{{ $report->province }}, {{ $report->regency }}, {{ $report->district }}, {{ $report->village }}</p>
                                <p class="text-gray-500 text-sm">{{ $report->user->email }}</p>
                            </div>
                            <div class="px-4 py-2 border-t flex justify-between items-center text-sm text-gray-600">
                                <div class="flex items-center gap-4">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg> {{ $report->viewers }}
                                    </span>
                                    <span>❤️ {{ is_array(json_decode($report->voting ?? '[]', true)) ? count(json_decode($report->voting ?? '[]', true)) : 0 }}</span>
                                </div>
                                <form action="{{ route('reports.voting', ['id' => $report->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                        <i class="fas fa-thumbs-up mr-2"></i>
                                        {{ in_array(auth()->id(), json_decode($report->voting ?? '[]', true)) ? 'Unvote' : 'Vote' }}
                                    </button>
                                </form>
                                <span>{{ $report->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">Tidak ada laporan yang ditemukan untuk provinsi ini.</p>
            @endif
        </div>

        <!-- Right Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h5 class="text-lg font-bold mb-4">Informasi Pembuatan Pengaduan</h5>
            <ul class="space-y-3 text-gray-700">
                <li>Pengaduan hanya bisa dibuat jika Anda memiliki akun.</li>
                <li>Data harus benar dan dapat dipertanggungjawabkan.</li>
                <li>Proses tanggapan dalam 2x24 jam.</li>
                <li><a href="#" class="text-blue-600 hover:underline">Ikuti Tautan untuk Pengaduan</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
            method: "GET",
            success: function (data) {
                const options = data.map(item =>
                    `<option value="${item.name}" ${item.name === "{{ $provinceId }}" ? 'selected' : ''}>${item.name}</option>`
                ).join('');
                $('#provinsi').append(options);
            },
            error: function () {
                alert("Failed to load province data.");
            }
        });
    });
</script>
