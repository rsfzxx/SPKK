<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Nilai Karyawan</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-6">
            <a href="{{ route('addkaryawan.index') }}" class="btn btn-primary mb-3">Data Karyawan</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Jabatan</th>
                    <th>Absensi</th>
                    <th>Kerapihan</th>
                    <th>Loyalitas</th>
                    <th>Kinerja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->absensi }}</td>
                    <td>{{ $employee->kerapihan }}</td>
                    <td>{{ $employee->loyalitas }}</td>
                    <td>{{ $employee->kinerja }}</td>
                    <td>
                        <a href="{{ route('employees.showAddGradeForm', $employee->id) }}" class="btn btn-primary">Tambah Nilai</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
