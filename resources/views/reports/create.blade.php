<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #0b3c49;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-top: 30px;
}

.container {
    width: 400px;
    margin: 30px 50px 10px auto;
    background-color: #ffffff;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* position: relative; */
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 16px;
    font-weight: bold;
    color: #34495e;
}

input[type="text"],
input[type="file"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    color: #34495e;
    transition: border-color 0.3s;
}

input[type="file"] {
    padding: 5px;
}

textarea {
    height: 100px;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #2980b9;
    outline: none;
}

button {
    background-color: #2980b9;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s;
}

button:hover {
    background-color: #1c5980;
    transform: scale(1.02);
}

button:active {
    transform: scale(0.98);
}

.error {
    color: red;
    font-size: 14px;
    background-color: #ffe6e6;
    border: 1px solid red;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.error ul {
    list-style-type: none;
    padding-left: 0;
}

.error li {
    margin: 5px 0;
}

select[disabled],
input[disabled] {
    background-color: #e0e0e0;
    color: #a0a0a0;
    cursor: not-allowed;
}

@media (max-width: 600px) {
    .container {
        width: 100%;
        margin: 0;
        padding: 20px;
    }

    button {
        width: 100%;
        padding: 14px;
    }
}
    </style>
</head>
<body>

    <h1>Create New Report</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <!-- Form -->
        <h2 class="title">Laporan Baru</h2>

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="type">Tipe Laporan:</label>
                <select id="type" name="type" required>
                    <option value="KEJAHATAN">Kejahatan</option>
                    <option value="PEMBANGUNAN">Pembangunan</option>
                    <option value="SOSIAL">Sosial</option>
                </select>
                <span>Select the type of report.</span>
            </div>

            <div class="form-group">
                <label for="province">Provinsi:</label>
                <select name="province" id="provinsi" required>
                    <option value="" selected>Pilih Provinsi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="regency">Kota/Kabupaten:</label>
                <select name="regency" id="kota" required disabled>
                    <option value="" selected>Pilih Kota/Kabupaten</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subdistrict">Kecamatan:</label>
                <select name="subdistrict" id="kecamatan" required disabled>
                    <option value="" selected>Pilih Kecamatan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="village">Village:</label>
                <select name="village" id="village" disabled>
                    <option value="" selected>Pilih Village</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                <span>Provide a detailed description of the report.</span>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit">Create Report</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            // Load Provinces
            $.ajax({
                url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "GET",
                success: function (data) {
                    const options = data.map(item => `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`).join('');
                    $('#provinsi').append(options);
                },
                error: function () {
                    alert("Failed to load province data.");
                }
            });

            // When Province is selected, load Regencies
            $('#provinsi').change(function () {
                const provinsiId = $(this).children('option:selected').data('id');
                console.log(provinsiId)
                if (provinsiId) {
                    $('#kota').prop('disabled', false);
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`,
                        method: "GET",
                        success: function (data) {
                            const options = data.map(item => `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`).join('');
                            $('#kota').html('<option value="" selected>Pilih Kota/Kabupaten</option>' + options);
                            $('#kecamatan').html('<option value="" selected>Pilih Kecamatan</option>').prop('disabled', true);
                            $('#village').html('<option value="" selected>Pilih Village</option>').prop('disabled', true);
                        },
                        error: function () {
                            alert("Failed to load regency data.");
                        }
                    });
                } else {
                    $('#kota').prop('disabled', true).html('<option value="" selected>Pilih Kota/Kabupaten</option>');
                    $('#kecamatan').prop('disabled', true).html('<option value="" selected>Pilih Kecamatan</option>');
                    $('#village').prop('disabled', true).html('<option value="" selected>Pilih Village</option>');
                }
            });

            // When Regencies is selected, load Districts
            $('#kota').change(function () {
                const kotaId = $(this).children('option:selected').data('id');
                if (kotaId) {
                    $('#kecamatan').prop('disabled', false);
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`,
                        method: "GET",
                        success: function (data) {
                            const options = data.map(item => `<option value="${item.id}" data-id="${item.id}">${item.name}</option>`).join('');
                            $('#kecamatan').html('<option value="" selected>Pilih Kecamatan</option>' + options);
                            $('#village').html('<option value="" selected>Pilih Village</option>').prop('disabled', true);
                        },
                        error: function () {
                            alert("Failed to load district data.");
                        }
                    });
                } else {
                    $('#kecamatan').prop('disabled', true).html('<option value="" selected>Pilih Kecamatan</option>');
                    $('#village').prop('disabled', true).html('<option value="" selected>Pilih Village</option>');
                }
            });

            // When Kecamatan is selected, load Village
            $('#kecamatan').change(function () {
                const kecamatanId = $(this).children('option:selected').data('id');
                if (kecamatanId) {
                    $('#village').prop('disabled', false);
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`,
                        method: "GET",
                        success: function (data) {
                            const options = data.map(item => `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`).join('');
                            $('#village').html('<option value="" selected>Pilih Village</option>' + options);
                        },
                        error: function () {
                            alert("Failed to load village data.");
                        }
                    });
                } else {
                    $('#village').prop('disabled', true).html('<option value="" selected>Pilih Village</option>');
                }
            });
        });
    </script>
</body>
</html>
