<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Pengaduan</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .report-header {
            background-color: orange;
            color: white;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .report-header:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-4">
        <h1 class="text-center">Daftar Pengaduan</h1>

        @foreach ($reports as $report)
            <div class="mb-3">
                <!-- Header Tanggal -->
                <div class="report-header" data-bs-toggle="collapse" data-bs-target="#report-{{ $loop->index }}">
                    Pengaduan {{ $report->created_at->format('d F Y') }}
                </div>

                <!-- Detail Pengaduan -->
                <div id="report-{{ $loop->index }}" class="collapse">
                    <div class="card card-body">
                        <!-- Tabs Navigasi -->
                        <ul class="nav nav-tabs" id="tab-{{ $loop->index }}" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="data-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#data-{{ $loop->index }}" type="button" role="tab" aria-controls="data-{{ $loop->index }}" aria-selected="true">Data</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#image-{{ $loop->index }}" type="button" role="tab" aria-controls="image-{{ $loop->index }}" aria-selected="false">Gambar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="status-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#status-{{ $loop->index }}" type="button" role="tab" aria-controls="status-{{ $loop->index }}" aria-selected="false">Status</button>
                            </li>
                        </ul>

                        <!-- Konten Tabs -->
                        <div class="tab-content mt-3" id="tabContent-{{ $loop->index }}">
                            <!-- Tab Data -->
                            <div class="tab-pane fade show active" id="data-{{ $loop->index }}" role="tabpanel" aria-labelledby="data-tab-{{ $loop->index }}">
                                <p><strong>Tipe:</strong> {{ $report->type }}</p>
                                <p><strong>Lokasi:</strong> {{ $report->province, $report->city, $report->district, $report->village }}</p>
                                <p><strong>Deskripsi:</strong> {{ $report->description }}</p>
                            </div>
                            <!-- Tab Gambar -->
                            <div class="tab-pane fade" id="image-{{ $loop->index }}" role="tabpanel" aria-labelledby="image-tab-{{ $loop->index }}">
                                @if ($report->image)
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="Image Pengaduan" class="img-fluid" style="max-width: 300px;">
                                @else
                                    <p>Tidak ada gambar.</p>
                                @endif
                            </div>
                            <!-- Tab Status -->
                            <div class="tab-pane fade" id="status-{{ $loop->index }}" role="tabpanel" aria-labelledby="status-tab-{{ $loop->index }}">
                                <p><strong>Status Pengaduan:</strong> STAFF belum merespon pengaduan kamu</p>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
