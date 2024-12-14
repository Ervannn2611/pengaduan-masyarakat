<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocean Landing Page</title>
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

            background-color: #0b3c49;
            color: white;
            display: flex;
            /* flex-direction: column; */
            /* justify-content: center; */
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

        /* Form styling */
        .form-container {
            width: 100%;
            max-width: 400px;
            background-color: rgba(0, 0, 0, 0.055);
            padding: 30px;
            border-radius: 8px;
        }

        .form-container label {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            background-color: #fff;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
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
            <div class="form-container">
                <h2>Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            @if(session('status'))
                            <p>{{ session('status') }}</p>
                            @endif

                        </ul>
                    </div>
                @endif>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
