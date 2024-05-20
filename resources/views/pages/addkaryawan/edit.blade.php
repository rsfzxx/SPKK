<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Karyawan</h1>
        <form action="{{ route('addkaryawan.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="full_name">Nama Lengkap :</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $employee->full_name }}">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Tanggal Lahir :</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $employee->date_of_birth }}">
            </div>
            <div class="form-group">
                <label for="position">Jabatan :</label>
                <select name="position" id="position" class="form-control">
                    <option value="Manager" {{ $employee->position == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Capten Crew" {{ $employee->position == 'Capten Crew' ? 'selected' : '' }}>Capten Crew</option>
                    <option value="Crew" {{ $employee->position == 'Crew' ? 'selected' : '' }}>Crew</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
