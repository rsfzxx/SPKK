<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class HasilController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        $totalAbsensi = 0;
        $totalLoyalitas = 0;
        $totalKerapihan = 0;
        $totalKinerja = 0;
        
        foreach ($employees as $employee) {
            $employee->absensi = $this->convertToGrade($employee->absensi);
            $employee->kerapihan = $this->convertToGrade($employee->kerapihan);
            $employee->loyalitas = $this->convertToGrade($employee->loyalitas);
            $employee->kinerja = $this->convertToGrade($employee->kinerja);
    
            $employee->absensi_normalized = $this->calculateNormalizedScore($employee->absensi, 20);
            $employee->kerapihan_normalized = $this->calculateNormalizedScore($employee->kerapihan, 20);
            $employee->loyalitas_normalized = $this->calculateNormalizedScore($employee->loyalitas, 30);
            $employee->kinerja_normalized = $this->calculateNormalizedScore($employee->kinerja, 30);

            $employee->total_normalized_score = $this->calculateTotalNormalizedScore($employee->absensi_normalized, $employee->kerapihan_normalized, $employee->loyalitas_normalized, $employee->kinerja_normalized);

            $totalAbsensi += $employee->absensi_normalized;
            $totalLoyalitas += $employee->loyalitas_normalized;
            $totalKerapihan += $employee->kerapihan_normalized;
            $totalKinerja += $employee->kinerja_normalized;
        }

        $avgAbsensi = $totalAbsensi / count($employees);
        $avgLoyalitas = $totalLoyalitas / count($employees);
        $avgKerapihan = $totalKerapihan / count($employees);
        $avgKinerja = $totalKinerja / count($employees);

        $top3Absensi = $this->calculateTop3($employees, 'absensi_normalized');
        $top3Kerapihan = $this->calculateTop3($employees, 'kerapihan_normalized');
        $top3Loyalitas = $this->calculateTop3($employees, 'loyalitas_normalized');
        $top3Kinerja = $this->calculateTop3($employees, 'kinerja_normalized');

        $sortedEmployees = $employees->sortByDesc('total_normalized_score');
        $top3Employees = $sortedEmployees->take(3);

        return view('pages.hasil.index', compact('employees', 'top3Employees', 'top3Absensi', 'top3Kerapihan', 'top3Loyalitas', 'top3Kinerja', 'avgAbsensi', 'avgLoyalitas', 'avgKerapihan', 'avgKinerja'));
    }
    

    private function convertToGrade($grade)
    {
        switch ($grade) {
            case 'A+':
                return 100;
            case 'A':
                return 95;
            case 'A-':
                return 90;
            case 'B+':
                return 85;
            case 'B':
                return 80;
            case 'B-':
                return 75;
            case 'C+':
                return 70;
            case 'C':
                return 65;
            case 'C-':
                return 60;
            case 'D':
                return 55;
            default:
                return 0;
        }
    }

    private function calculateNormalizedScore($value, $weight)
    {
        return ($value * $weight) / 1000;
    }

    private function calculateTotalNormalizedScore($absensi, $kerapihan, $loyalitas, $kinerja)
    {
        return $absensi + $kerapihan + $loyalitas + $kinerja;
    }

    private function calculateTop3($employees, $attribute)
    {
        $sortedEmployees = $employees->sortByDesc($attribute)->values()->all();

        $top3 = array_slice($sortedEmployees, 0, 3);

        return $top3;
    }
}
