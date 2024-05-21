<x-app-layout>
    <div class="container pt-5 bg-light min-h-screen">
        <a href="{{ route('addkaryawan.index') }}" class="inline-flex items-center ">
            <i class="bi bi-arrow-left-circle text-xl mr-1"></i>
            <span class="text-lg font-bold">List Karyawan</span>
        </a>
        <h1 class="text-center font-extrabold text-xl md:text-2xl pb-4">Edit Karyawan</h1>
        <form action="{{ route('addkaryawan.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container bg-white rounded border border-gray-100 pb-5">
                <div class="w-full max-w-xl mx-auto pt-4">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="full_name"
                                class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Nama Lengkap
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="text" name="full_name" id="full_name" value="{{ $employee->full_name }}"
                                class="bg-gray-100 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-indigo-500 ">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="date_of_birth"
                                class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Tanggal Lahir
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                value="{{ $employee->date_of_birth }}"
                                class="bg-gray-100 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-indigo-500 ">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="position" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Jabatan
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="position"
                                class="block w-full appearance-none bg-gray-100 border-2 border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="position">1
                                <option value="Crew" {{ $employee->position == 'Crew' ? 'selected' : '' }}>Crew
                                </option>
                                <option value="Capten Crew"
                                    {{ $employee->position == 'Capten Crew' ? 'selected' : '' }}>Capten Crew</option>
                                <option value="Manager" {{ $employee->position == 'Manager' ? 'selected' : '' }}>Manager
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <button type="submit"
                            class="shadow w-1/3 bg-green-500 hover:bg-green-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 mt-4 rounded">
                            Update
                        </button>
                        <div class="px-2"></div>
                        <a href="{{ route('addkaryawan.index') }}"
                            class="btn shadow w-1/3 bg-red-500 hover:bg-red-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 mt-4 rounded">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
