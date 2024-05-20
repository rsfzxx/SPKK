<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class NilaiKaryawanController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('pages.nilaikaryawan.index', compact('employees'));
    }

    public function showAddGradeForm($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.nilaikaryawan.addgrade', compact('employee'));
    }

    public function addGrade(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'absensi' => 'nullable|string|max:2',
            'kerapihan' => 'nullable|string|max:2',
            'loyalitas' => 'nullable|string|max:2',
            'kinerja' => 'nullable|string|max:2',
        ]);

        $employee = Employee::find($request->employee_id);
        $employee->absensi = $request->absensi;
        $employee->kerapihan = $request->kerapihan;
        $employee->loyalitas = $request->loyalitas;
        $employee->kinerja = $request->kinerja;
        $employee->save();

        return redirect()->route('nilaikaryawan.index')->with('success', 'Nilai Grade Berhasil Ditambahkan');
    }
}
