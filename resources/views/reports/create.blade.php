@extends('layouts.layout')
@section('title', 'Create Report')
@section('content')
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-teal-400 shadow-lg transform skew-y-0 rotate-3 sm:rotate-6 sm:skew-y-0 sm:rounded-lg"></div>
        <div class="relative bg-white shadow-lg sm:rounded-lg px-10 py-8">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Create New Report</h1>

            <!-- Error Validation -->
            @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg shadow mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Tipe Laporan -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe Laporan</label>
                    <select id="type" name="type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="KEJAHATAN">Kejahatan</option>
                        <option value="PEMBANGUNAN">Pembangunan</option>
                        <option value="SOSIAL">Sosial</option>
                    </select>
                </div>

                <!-- Provinsi -->
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                    <select name="province" id="provinsi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" selected>Pilih Provinsi</option>
                    </select>
                </div>

                <!-- Kota/Kabupaten -->
                <div>
                    <label for="regency" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                    <select name="regency" id="kota" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" selected>Pilih Kota/Kabupaten</option>
                    </select>
                </div>

                <!-- Kecamatan -->
                <div>
                    <label for="subdistrict" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <select name="subdistrict" id="kecamatan" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" selected>Pilih Kecamatan</option>
                    </select>
                </div>

                <!-- Desa -->
                <div>
                    <label for="village" class="block text-sm font-medium text-gray-700">Desa/Kelurahan</label>
                    <select name="village" id="village" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" selected>Pilih Desa/Kelurahan</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 h-28">{{ old('description') }}</textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 transition duration-150">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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

</script>
@endsection


