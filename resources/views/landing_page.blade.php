<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 text-gray-900">

    <!-- Container Utama -->
    <div class="min-h-screen flex flex-col md:flex-row items-stretch justify-center">

        <!-- Section Kiri -->
        <div class="flex-1 flex items-center justify-center bg-gradient-to-r from-blue-800 to-blue-900 text-white px-8 py-12">
            <div class="text-center space-y-6">
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-wide uppercase drop-shadow-md">
                    Pengaduan Masyarakat
                </h1>
                <p class="text-lg md:text-2xl font-light opacity-90 leading-relaxed">
                    Transparansi, akuntabilitas, dan solusi cepat untuk Anda.
                </p>
            </div>
        </div>

        <!-- Section Kanan -->
        <div class="flex-1 bg-white rounded-lg shadow-lg flex items-center justify-center px-6 py-12">
            <div class="max-w-md w-full text-center">
                <!-- Judul -->
                <h2 class="text-4xl font-bold text-blue-800 mb-6">
                    Layanan Pengaduan
                </h2>

                <!-- Deskripsi -->
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Laporkan keluhan Anda secara efisien melalui sistem pengaduan ini. Kami siap membantu Anda.
                </p>

                <!-- Tombol Login -->
                <div>
                    <a href="{{ route('login') }}"
                       class="inline-block bg-blue-600 text-white text-lg font-medium py-3 px-8 rounded-full shadow-lg hover:bg-blue-700 hover:scale-105 transition transform duration-300">
                        Bergabung
                    </a>
                </div>

                <!-- Garis Pembatas -->
                <div class="my-8 border-t border-gray-300"></div>

                <!-- Ikon Sosial -->
                <div class="flex justify-center space-x-6">
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition duration-300">
                        <i class="bi bi-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-pink-500 transition duration-300">
                        <i class="bi bi-instagram text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</body>
</html>
