<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FF6600;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            padding: 15px;
            background-color: #fff;
            border-bottom: 3px solid #FF6600;
        }

        .header h2 {
            font-size: 1.25rem;
            color: #555;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .content p {
            color: #555;
            font-size: 1rem;
            line-height: 1.7;
        }

        .content button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FFC107;
            color: #000;
            font-size: 0.9rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .content button:hover {
            background-color: #FFB300;
        }

        .image-container {
            margin-top: 20px;
            text-align: center;
        }

        .image-container img {
            max-width: 30%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background-color: #FFEBCC;
            border-left: 4px solid #FFA500;
            padding: 15px 20px;
            margin: 20px 0;
            font-size: 0.95rem;
        }

        .info-box ol {
            padding-left: 20px;
        }

        .info-box a {
            color: #FF6600;
            text-decoration: none;
        }

        .comment-section {
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }

        .comment-section h3 {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 20px;
        }

        .comment {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .comment strong {
            color: #555;
        }

        .comment small {
            color: #888;
        }

        .comment-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .comment-form button {
            display: block;
            background-color: #28a745;
            color: white;
            font-size: 0.9rem;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .comment-form button:hover {
            background-color: #218838;
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

    <div class="container">
        <div class="header">
            <h2>Kesenjangan Sosial</h2>
        </div>

        @if ($report)
        <div class="content">
            <h2>{{ $report->created_at->format('d F Y') }}</h2>
            <p>{{ $report->description }}</p>
            <button>{{ $report->type }}</button>

            <div class="image-container">
                <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Kesenjangan Sosial">
            </div>

            <div class="info-box">
                <p>Informasi Pembuatan Pengaduan:</p>
                <ol>
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <b>BENAR dan DAPAT DIPERTANGGUNGJAWABKAN</b>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 jam.</li>
                    <li>Periksa tanggapan Kami pada <b>Dashboard</b> setelah Anda Login.</li>
                    <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#">Ikuti Tautan</a>.</li>
                </ol>
            </div>
        </div>

        <div class="comment-section">
            <h3>Komentar</h3>

            <form class="comment-form" action="{{ route('reports.comen') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <textarea name="comment" rows="4" placeholder="Tulis komentar Anda..." required></textarea>
                <button type="submit">Buat Komentar</button>
            </form>
        </div>
            @foreach ($report->comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name }}</strong> <small>({{ $comment->user->email }})</small></p>
                <p><small>{{ $comment->created_at->format('d F Y, H:i') }}</small></p>
                <p>{{ $comment->comment }}</p>
            </div>
            @endforeach

        @else
        <p>Pengaduan tidak ditemukan.</p>
        @endif
    </div>

</body>
</html>
