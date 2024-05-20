<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Karyawan Baru</h1>
        <form action="{{ route('addkaryawan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Nama Lengkap :</label>
                <input type="text" name="full_name" id="full_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Tanggal Lahir :</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
            </div>
            <div class="form-group">
                <label for="position">Jabatan :</label>
                <select name="position" id="position" class="form-control">
                    <option value="Crew">Crew</option>
                    <option value="Capten Crew">Capten Crew</option>
                    <option value="Manager">Manager</option>
                </select>
            </div>            
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
