<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login atau Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 h-screen flex items-center justify-center">

    <!-- Container Utama -->
    <div class="flex flex-col md:flex-row bg-white shadow-2xl rounded-lg overflow-hidden max-w-4xl mx-auto">

        <!-- Section Kiri -->
        <div class="hidden md:flex flex-1 bg-gradient-to-br from-blue-600 to-blue-800 text-white items-center justify-center">
            <div class="text-center p-8">
                <h1 class="text-4xl font-bold mb-4 uppercase drop-shadow-lg">Pengaduan Masyarakat</h1>
                <p class="text-lg font-light leading-relaxed">
                    Transparansi dan solusi cepat untuk permasalahan Anda.
                </p>
            </div>
        </div>

        <!-- Section Kanan -->
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Header -->
                <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">Login atau Daftar</h2>

                <!-- Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-gray-600 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    </div>
                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-gray-600 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between">
                        <button type="submit" name="action" value="login"
                            class="w-[48%] bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Login
                        </button>
                        <button type="submit" name="action" value="register"
                            class="w-[48%] bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition">
                            Daftar
                        </button>
                    </div>
                </form>

                <!-- Error Message -->
                @if ($errors->any())
                    <div class="mt-4 text-red-600 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>

</body>
</html>
