<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class AddKaryawanController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('pages.addkaryawan.index', compact('employees'));
    }

    public function create()
    {
        return view('pages.addkaryawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'position' => 'required|string|max:255',
        ]);

        Employee::create([
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'position' => $request->position,
        ]);

        return redirect()->route('addkaryawan.index')->with('success', 'Data Karyawan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.addkaryawan.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'position' => 'required|string|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'position' => $request->position,
        ]);

        return redirect()->route('addkaryawan.index')->with('success', 'Data Karyawan Berhasil Diperbaharui');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('addkaryawan.index')->with('success', 'Data Karyawan Berhasil Dihapus');
    }
}
