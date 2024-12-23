<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tanggapan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 font-sans antialiased">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="container mx-auto my-5 p-4 bg-white rounded-lg shadow-lg">
        <!-- Header Info -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h5 class="text-xl font-semibold text-gray-800">{{ $report->user->email }}</h5>
                <small class="text-sm text-gray-500">{{ $report->created_at->format('d M Y H:i') }}</small>
                <p class="mt-2 text-sm">
                    <strong>Status tanggapan:</strong>
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white {{ $report->responses->last()->response_status === 'ON_PROCESS' ? 'bg-yellow-500' : ($report->responses->last()->response_status === 'DONE' ? 'bg-green-500' : 'bg-red-500') }} rounded-full">
                        {{ $report->responses->last()->response_status ?? 'Belum Ada' }}
                    </span>
                </p>
            </div>
            <div>
                <a href="{{ route('staff.dashboard') }}" class="text-sm text-gray-800 bg-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-400 transition">Kembali</a>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6">
                        <h6 class="text-lg font-bold text-gray-800 uppercase mb-3">
                            {{ $report->province }}, {{ $report->regency }}, {{ $report->district }}, {{ $report->village }}
                        </h6>
                        <p class="text-gray-700">{{ $report->description }}</p>
                        @if ($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Proses" class="mt-4 w-full h-64 object-cover rounded-lg">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="col-span-1">
                <h6 class="text-lg font-bold text-gray-800 mb-4">Progress</h6>
                <div class="space-y-4">
                    @if ($report->responseProgress && $report->responseProgress->isNotEmpty())
                        @foreach ($report->responseProgress->sortByDesc('created_at') as $progress)
                            <div class="flex items-start space-x-4">
                                <span class="flex-shrink-0 w-3 h-3 bg-gray-700 rounded-full"></span>
                                <div>
                                    <small class="text-sm text-gray-500">
                                        {{ $progress->created_at->format('d M Y, H:i') }}
                                    </small>
                                    <p class="text-sm text-gray-800">{{ $progress->histories }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Belum ada progress.</p>
                    @endif
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-6 space-x-4">
            <button id="openModalBtn" type="button" class="px-6 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition">
                Tambah Progress
            </button>
            <form action="{{ route('staff.done', $report->id) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <button type="submit" class="px-6 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 transition">
                    Nyatakan Selesai
                </button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="addProgressModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white w-1/3 mx-auto mt-20 p-6 rounded-lg shadow-lg">
            <h5 class="text-lg font-semibold mb-4">Tambah Progress</h5>
            <form action="{{ route('staff.store', ['id' => $report->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <input type="hidden" name="response_id" value="{{ $report->responses->last()->id ?? '' }}">
                <textarea name="histories" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="Masukkan progress..."></textarea>
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const addProgressModal = document.getElementById('addProgressModal');

        openModalBtn.addEventListener('click', () => {
            addProgressModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            addProgressModal.classList.add('hidden');
        });
    </script>
</body>
</html>

