@extends('layouts.layout')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="bg-gray-100 min-h-screen font-poppins">
    @if (session('success'))
    <!-- Alert Pesan Sukses -->
    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg shadow-md mt-6 max-w-3xl mx-auto relative">
        <p>{{ session('success') }}</p>
        <button type="button" class="absolute top-2 right-2 text-green-800 hover:text-green-900 focus:outline-none" onclick="this.parentElement.remove();">&times;</button>
    </div>
    @endif

    <div class="container mx-auto py-10 px-4">

        @foreach ($reports as $report)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8 transition-transform duration-300 hover:scale-105">
            <!-- Header Tanggal -->
            <div class="flex justify-between items-center bg-gradient-to-r from-blue-500 to-purple-700 text-white px-6 py-4 cursor-pointer hover:from-blue-600 hover:to-purple-800 transition duration-300"
                data-bs-toggle="collapse" data-bs-target="#report-{{ $loop->index }}">
                <span class="text-lg font-semibold">
                    Pengaduan - {{ $report->created_at->format('d F Y') }}
                </span>
                <svg class="w-6 h-6 transform transition-transform duration-300" data-icon="dropdown" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5.516 7.548a1 1 0 011.415 0L10 10.616l3.07-3.07a1 1 0 011.414 1.415l-3.777 3.776a1 1 0 01-1.414 0L5.516 8.963a1 1 0 010-1.415z"/>
                </svg>
            </div>

            <!-- Konten Pengaduan -->
            <div id="report-{{ $loop->index }}" class="hidden">
                <div class="p-6 bg-gray-50">
                    <!-- Tabs -->
                    <div class="flex justify-center space-x-6 mb-6">
                        <button class="tab-btn px-4 py-2 text-gray-700 font-medium hover:text-blue-600 transition duration-300 focus:outline-none border-b-2 border-transparent"
                            data-target="data-{{ $loop->index }}">Data</button>
                        <button class="tab-btn px-4 py-2 text-gray-700 font-medium hover:text-blue-600 transition duration-300 focus:outline-none border-b-2 border-transparent"
                            data-target="image-{{ $loop->index }}">Gambar</button>
                        <button class="tab-btn px-4 py-2 text-gray-700 font-medium hover:text-blue-600 transition duration-300 focus:outline-none border-b-2 border-transparent"
                            data-target="status-{{ $loop->index }}">Status</button>
                    </div>

                    <!-- Tab Content -->
                    <div id="data-{{ $loop->index }}" class="tab-pane hidden">
                        <p class="text-gray-700 mb-4"><span class="font-semibold">Tipe:</span> {{ $report->type }}</p>
                        <p class="text-gray-700 mb-4"><span class="font-semibold">Lokasi:</span> {{ $report->province }}, {{ $report->regency }}, {{ $report->district }}, {{ $report->village }}</p>
                        <p class="text-gray-700"><span class="font-semibold">Deskripsi:</span> {{ $report->description }}</p>
                    </div>
                    <div id="image-{{ $loop->index }}" class="tab-pane hidden">
                        @if ($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Pengaduan" class="max-w-md h-64 mx-auto rounded-lg shadow-md">
                        @else
                        <p class="text-gray-500">Tidak ada gambar tersedia.</p>
                        @endif
                    </div>
                    <div id="status-{{ $loop->index }}" class="tab-pane hidden">
                        @if ($report->responses->isNotEmpty())
                        <div class="bg-gradient-to-r from-purple-500 to-purple-400 text-white rounded-lg p-6 shadow-lg">
                            <p class="text-base font-semibold mb-4">
                                Pengaduan telah ditanggapi, dengan status:
                                <span class="inline-block bg-green-600 text-white rounded-full px-4 py-1 text-sm font-bold shadow-md">
                                    {{ $report->responses->last()->response_status }}
                                </span>
                            </p>
                            <div class="divide-y divide-orange-200">
                                @foreach ($report->responseProgress as $index => $response)
                                <div class="flex items-start py-3 {{ $loop->last ? '' : 'border-b border-orange-200' }}">
                                    <div class="w-2 h-2 mt-1.5 bg-gray-800 rounded-full flex-shrink-0"></div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-100 font-medium">
                                            {{ $response->created_at->format('d F Y') }}
                                        </p>
                                        <p class="text-sm text-gray-200">
                                            {{ $response->histories }}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="flex justify-between items-center bg-gradient-to-r from-purple-500 to-purple-400 text-white p-4 rounded-lg shadow-md">
                            <p class="text-gray-600">Belum ada tanggapan.</p>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition-shadow">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Script Tabs -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.dataset.target;

                tabContents.forEach(content => content.classList.add('hidden'));
                tabButtons.forEach(btn => btn.classList.remove('border-blue-500', 'text-blue-600'));

                document.getElementById(targetId).classList.remove('hidden');
                button.classList.add('border-blue-500', 'text-blue-600');
            });
        });

        if (tabButtons.length && tabContents.length) {
            tabButtons[0].classList.add('border-blue-500', 'text-blue-600');
            tabContents[0].classList.remove('hidden');
        }

        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.dataset.bsTarget);
                target.classList.toggle('hidden');
                button.querySelector('[data-icon="dropdown"]').classList.toggle('rotate-180');
            });
        });
    });
</script>
@endsection
