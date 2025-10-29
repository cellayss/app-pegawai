<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('departemen', 'jabatan')->latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }
        
    public function create()
    {
        $departemens = Departemen::all();
        $jabatans = Jabatan::all(); // ✅ pindahkan sebelum return
        
        return view('employees.create', compact('departemens', 'jabatans')); // ✅ tambahkan jabatans
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif', // ✅ validasi spesifik
            'departemen_id' => 'required|exists:departments,id', // ✅ perbaiki nama tabel
            'jabatan_id' => 'required|exists:positions,id',
        ]);

        Employee::create($request->all());
        
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $employee = Employee::with('departemen', 'jabatan')->findOrFail($id); // ✅ tambahkan jabatan
        return view('employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departemens = Departemen::all();
        $jabatans = Jabatan::all(); // ✅ tambahkan ini
        
        return view('employees.edit', compact('employee', 'departemens', 'jabatans')); // ✅ tambahkan jabatans
    }

    public function update(Request $request, string $id)
{
    $employee = Employee::findOrFail($id);
    
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:employees,email,' . $id,
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|in:aktif,nonaktif', // ✅ diperbaiki
        'departemen_id' => 'nullable|exists:departments,id', // ✅ diperbaiki
        'jabatan_id' => 'nullable|exists:positions,id', // ✅ diperbaiki
    ]);

     $updated = $employee->update($request->only([
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ]));

    \Log::info('HASIL UPDATE:', ['success' => $updated]);

    return redirect()->route('employees.index')
        ->with('success', 'Data pegawai berhasil diperbarui!');
}

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}