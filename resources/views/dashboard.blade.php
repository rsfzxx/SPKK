<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('addkaryawan.index') }}" class="btn btn-primary btn-block">Add Karyawan</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('nilaikaryawan.index') }}" class="btn btn-secondary btn-block">Nilai Karyawan</a>
        </div>
    </div>
</x-app-layout>
