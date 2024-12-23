<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <!-- Export Button -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Export (.xlsx)
            </button>
            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                <li><a class="dropdown-item" href="{{ route('staff.export') }}">Export Data</a></li>
            </ul>
        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Gambar & Pengirim</th>
                        <th scope="col">Lokasi & Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Jumlah Vote</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td class="d-flex align-items-center">
                            <!-- Thumbnail Gambar -->
                            <img src="{{ asset('storage/' . $report->image) }}" alt="User" class="rounded-circle me-2 img-thumbnail" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-image="{{ asset('storage/' . $report->image) }}">
                            <a href="mailto:{{ $report->user->email }}" class="text-decoration-none">{{ $report->user->email }}</a>
                        </td>
                        <td>
                            <p class="mb-0">{{ $report->province }}, {{ $report->regency }}, {{ $report->district }}, {{ $report->village }}</p>
                            <small class="text-muted">{{ $report->created_at }}</small>
                        </td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->voting }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <!-- Tombol Tindak Lanjut -->
                                        <button
                                        class="dropdown-item btn-response"
                                        data-id="{{ $report->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#responseModal">
                                        Tindak Lanjut
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Image Detail -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Detail Gambar" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Response (Tanggapan) -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Tindak Lanjut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form untuk Update Status -->
                <form id="responseForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="response" class="block text-gray-700">Pilih Tindakan:</label>
                        <select name="response" id="responseSelect" class="border border-gray-300 rounded-lg w-full p-2 mt-2">
                            <option value="Proses Perbaikan">Proses Perbaikan</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitResponse" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                            Perbarui Tanggapan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Script for Modal Image -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Handle Modal Image
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            imageModal.addEventListener('show.bs.modal', event => {
                const triggerElement = event.relatedTarget;
                const imageSrc = triggerElement.getAttribute('data-image');
                modalImage.setAttribute('src', imageSrc);
            });

            // Handle Tindak Lanjut
            const responseButtons = document.querySelectorAll('.btn-response');
            const responseForm = document.getElementById('responseForm');
            const responseSelect = document.getElementById('responseSelect');
            const submitResponseButton = document.getElementById('submitResponse');

            responseButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const reportId = button.getAttribute('data-id');
                    responseForm.action = `{{ route('staff.update', '') }}/${reportId}`;
                });
            });
        });
    </script>

</body>
</html>

