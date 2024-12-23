<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn-reset {
            background-color: #007bff;
            color: white;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }
        .alert-success {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Card Akun Staff -->
            <div class="col-md-8">
                <div class="card p-3">
                    <h5 class="mb-3">Akun Staff Daerah JAWA BARAT</h5>
                    <!-- Tabel Data Staff -->
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            @if ($item->role == 'STAFF')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <button class="btn btn-sm btn-reset me-2">Reset</button>
                                    <form action="{{ route('headstaff.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card Buat Akun Staff -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5 class="mb-3">Buat Akun Staff</h5>
                    <form action="{{ route('headstaff.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan sandi" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Buat</button>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{ route('headstaff.dashboard') }}" class="btn btn-primary">Back</a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
