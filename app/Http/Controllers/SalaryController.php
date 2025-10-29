<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee.jabatan')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'aktif')
                             ->with('jabatan')
                             ->orderBy('nama_lengkap')
                             ->get();
        
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ], [
            'karyawan_id.required' => 'Karyawan harus dipilih',
            'karyawan_id.exists' => 'Karyawan tidak ditemukan',
            'bulan.required' => 'Bulan harus diisi',
            'gaji_pokok.required' => 'Gaji pokok harus diisi',
            'gaji_pokok.numeric' => 'Gaji pokok harus berupa angka',
            'gaji_pokok.min' => 'Gaji pokok minimal 0',
        ]);

        // Check if salary already exists for this employee and month
        $exists = Salary::where('karyawan_id', $request->karyawan_id)
                       ->where('bulan', $request->bulan)
                       ->exists();

        if ($exists) {
            return back()->withErrors(['bulan' => 'Gaji untuk karyawan ini pada periode tersebut sudah ada'])
                        ->withInput();
        }

        // Total gaji akan dihitung otomatis di model (booted method)
        Salary::create($request->all());

        return redirect()->route('salaries.index')
                        ->with('success', 'Data gaji berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $salary = Salary::with('employee.jabatan', 'employee.departemen')->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    public function edit(string $id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::where('status', 'aktif')
                             ->with('jabatan')
                             ->orderBy('nama_lengkap')
                             ->get();
        
        return view('salaries.edit', compact('salary', 'employees'));
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'bulan' => [
            'required',
            'date_format:Y-m',
            Rule::unique('salaries', 'bulan')->where(function ($query) use ($request) {
                return $query->where('karyawan_id', $request->employee_id); // Pakai karyawan_id
            })->ignore($id)
        ],
        'gaji_pokok' => 'required|numeric|min:0',
        'tunjangan' => 'nullable|numeric|min:0',
        'potongan' => 'nullable|numeric|min:0',
        'keterangan' => 'nullable|string',
    ], [
        'employee_id.required' => 'Pegawai harus dipilih',
        'employee_id.exists' => 'Pegawai tidak valid',
        'bulan.required' => 'Periode harus diisi',
        'bulan.unique' => 'Gaji untuk pegawai ini pada periode yang sama sudah ada',
        'gaji_pokok.required' => 'Gaji pokok harus diisi',
    ]);

    $salary = Salary::findOrFail($id);
    
    // Update dengan mapping yang benar
    $salary->update([
        'karyawan_id' => $request->employee_id,  // Mapping dari employee_id ke karyawan_id
        'bulan' => $request->bulan,
        'gaji_pokok' => $request->gaji_pokok,
        'tunjangan' => $request->tunjangan ?? 0,
        'potongan' => $request->potongan ?? 0,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('salaries.index')
        ->with('success', 'Data gaji berhasil diperbarui');
}

    public function destroy(string $id)
    {
        $salary = Salary::findOrFail($id);
        
        $employeeName = $salary->employee->nama_lengkap;
        $periode = $salary->periode;
        
        $salary->delete();

        return redirect()->route('salaries.index')
                        ->with('success', "Data gaji {$employeeName} periode {$periode} berhasil dihapus!");
    }
}