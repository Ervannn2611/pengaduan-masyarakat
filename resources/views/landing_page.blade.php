<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PM|Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            background-color: #0b3c49; /* Menghilangkan warna putih di pinggiran */
        }

        .container-fluid {
            height: 100vh;
            display: flex;
            flex-direction: row;
            margin: 0;
        }

        .image-section {
            background: url('https://images.tokopedia.net/img/JFrBQq/2022/6/22/82d59c69-3324-4f53-9752-e711ff61f7b2.jpg') no-repeat center center/cover;
            flex: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .image-section h1 {
            color: white;
            font-size: 3rem;
            border: 2px solid white;
            padding: 10px 20px;
            text-align: center;
        }

        .image-section .menu {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .text-section {
            flex: 1;
            background-color: #0b3c49;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .text-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .text-section p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
        }

        .text-section a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .text-section a:hover {
            background: #0056b3;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column;
            }

            .image-section {
                flex: 1;
                height: 50vh;
            }

            .image-section h1 {
                font-size: 2rem;
                padding: 8px 16px;
            }

            .text-section {
                flex: 1;
                padding: 10px;
            }

            .text-section h2 {
                font-size: 2rem;
            }

            .text-section p {
                font-size: 0.9rem;
            }

            .text-section a {
                padding: 8px 16px;
                font-size: 0.9rem;
            }

            .social-icons a {
                font-size: 1.2rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Image Section -->
        <div class="image-section">
            <div class="menu">Beranda</div>
            <h1>PENGADUAN MASYARAKAT</h1>
        </div>

        <!-- Text Section -->
        <div class="text-section">
            <h2>LAYANAN PENGADUAN</h2>
            <p>Pengaduan Masyarakat adalah layanan pengaduan yang diberikan kepada pihak pemerintah untuk menanggapi masalah-masalah yang dialami masyarakat secara langsung. Sistem ini dirancang untuk meningkatkan transparansi dan akuntabilitas dalam menangani permasalahan publik.</p>
            <a href="{{ route('login') }}">Login</a>
            <div class="social-icons">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
