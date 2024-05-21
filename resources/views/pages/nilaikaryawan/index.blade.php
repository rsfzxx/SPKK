<x-app-layout>
    <div class="container pt-5 bg-light">
        <h1 class="text-center font-extrabold text-xl md:text-2xl">Penilaian Karyawan</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container flex justify-end items-center pt-4">
            <div class="flex items-center">
                <a href="{{ route('addkaryawan.index') }}" class="btn bg-green-600 text-white hover:bg-green-700 ">
                    <i class="bi bi-arrow-left-circle"></i>
                    List Karyawan
                </a>
            </div>
            <div class="flex items-center ml-3">
                <a href="{{ route('hasil.index') }}" class="btn bg-red-600 text-white hover:bg-red-700 ">
                    <i class="bi bi-bar-chart-fill"></i>
                    Hasil Akhir
                </a>
            </div>
        </div>

        <div class="container pt-3 pb-5">
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
                                <a href="{{ route('employees.showAddGradeForm', $employee->id) }}"
                                    class="btn btn-primary">Tambah Nilai</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
