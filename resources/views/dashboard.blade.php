<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0b3c49;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .left-section {
            flex: 1 1 70%;
        }
        .header {
            background-color: #ffffff;
            padding: 15px 25px;
            margin-bottom: 20px;
            color: #0b3c49;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
        }
        .header a {
            color: #0b3c49;
            text-decoration: none;
        }
        .search-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        .card img {
            width: 220px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .card-body {
            flex: 1;
        }
        .card-body h5 {
            margin: 0 0 5px;
            font-size: 1.2rem;
            color: #007bff;
        }
        .card-body p {
            margin: 5px 0;
            color: #666;
            font-size: 0.9rem;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #888;
        }
        .card-footer .icon {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .icon span {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .right-section {
            flex: 1 1 25%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .right-section h5 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .right-section ul {
            list-style-type: none;
            padding: 0;
        }
        .right-section ul li {
            margin-bottom: 10px;
        }
        .right-section ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .right-section ul li a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-section, .right-section {
                flex: 1 1 100%;
            }
            .search-bar {
                flex-direction: column;
            }
            .search-bar button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="header">
                <a href="{{ route('reports.create') }}">Buat Pengaduan</a>
            </div>
            <a href="{{ route('logout') }}">Logout</a>
            <div class="search-bar">
                <select class="form-select" id="provinsi">
                    <option selected>Pilih Provinsi</option>
                </select>
                <button class="btn btn-primary">Cari</button>
            </div>
            <div class="container">
                @foreach ($reports as $report)
                <div class="card">
                    <div class="card-left">
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Pengaduan">
                    </div>
                    <div class="card-body">
                        <h5><a href="{{ route('reports.show', $report->id) }}">{{ $report->description }}</a></h5>
                        <p>
                            {{ $report->province }}, {{ $report->regency }},
                            {{ $report->district }}, {{ $report->village }}
                        </p>
                        <p>{{ $report->user->email }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="icon">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg> {{ $report->views ?? 0 }}
                            </span>
                            <span class="like-button" data-id="{{ $report->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg> <span class="voting-count">{{ $report->voting ?? 0 }}</span>
                            </span>
                        </div>
                        <div>{{ $report->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="right-section">
            <h5>Informasi Pembuatan Pengaduan</h5>
            <ul>
                <li>Pengaduan hanya bisa dibuat jika Anda memiliki akun.</li>
                <li>Data harus benar dan dapat dipertanggungjawabkan.</li>
                <li>Proses tanggapan dalam 2x24 jam.</li>
                <li><a href="#">Ikuti Tautan untuk Pengaduan</a></li>
            </ul>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load Provinces
            $.ajax({
                url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "GET",
                success: function (data) {
                    const options = data.map(item => `<option value="${item.name}">${item.name}</option>`).join('');
                    $('#provinsi').append(options);
                },
                error: function () {
                    alert("Failed to load province data.");
                }
            });

            // Event listener untuk tombol "like"
            $('.like-button').on('click', function () {
                const reportId = $(this).data('id');
                const likeCountElement = $(this).find('.voting-count');

                $.ajax({
                    url: `/reports/voting/${reportId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            likeCountElement.text(response.voting);
                        } else {
                            alert('Gagal menambahkan like.');
                        }
                    },
                    error: function (xhr) {
                        const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat menambahkan like.';
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
</body>
</html>
