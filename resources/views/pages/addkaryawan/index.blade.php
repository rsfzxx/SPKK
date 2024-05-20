<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Karyawan</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-6">
            <a href="{{ route('addkaryawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
            <a href="{{ route('nilaikaryawan.index') }}" class="btn btn-success mb-3">Tambah Nilai Karyawan</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>
                        <a href="{{ route('addkaryawan.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('addkaryawan.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin menghapus Karyawan ?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
