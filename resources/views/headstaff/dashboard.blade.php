{{-- @extends('layouts.layout')
@section('title','HEAD STAFF')

@section('content') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        color: #2c3e50;
        font-size: 24px;
    }

    canvas {
        display: block;
        margin: 0 auto;
        width: 80%; /* Lebar canvas agar responsif */
        height: 300px; /* Tinggi canvas */
    }

    @media screen and (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        canvas {
            width: 100%; /* Lebar penuh di layar kecil */
            height: 300px;
        }
    }
</style>

<!-- Tombol untuk membuat akun staff -->

<!-- Container Chart -->
<div class="container">
    <h2>Jumlah Pengaduan dan Tanggapan terhadap Pengaduan<br>JAWA BARAT</h2>
    <canvas id="barChart"></canvas>
    <a href="{{ route('headstaff.create') }}" class="btn btn-success ">Buat Akun Staff</a>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    const reports = @json($reports ?? 0);
    const responses = @json($responses ?? 0);

    const ctx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Reports', 'Responses'], // Labels untuk chart
            datasets: [{
                label: 'Total Data',
                data: [reports, responses], // Data dari backend
                backgroundColor: [
                    'rgba(173, 216, 230, 0.6)', // Light Blue
                    'rgba(255, 182, 193, 0.6)'  // Light Pink
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)', // Border Blue
                    'rgba(255, 99, 132, 1)' // Border Pink
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Naik per satuan
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
</body>
</html>
{{-- @endsection --}}


