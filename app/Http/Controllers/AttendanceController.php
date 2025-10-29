<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['employee.jabatan', 'employee.departemen'])
            ->latest('tanggal')
            ->latest('id');

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan pegawai
        if ($request->filled('karyawan_id')) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_absensi', $request->status);
        }

        $attendances = $query->paginate(15)->withQueryString();
        $employees = Employee::orderBy('nama_lengkap')->get();

        return view('attendances.index', compact('attendances', 'employees'));
    }

    public function create()
    {
        $employees = Employee::with('jabatan')->orderBy('nama_lengkap')->get();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                'exists:employees,id',
                Rule::unique('attendance')->where(function ($query) use ($request) {
                    return $query->where('karyawan_id', $request->karyawan_id)
                                ->whereDate('tanggal', $request->tanggal);
                })
            ],
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'karyawan_id.required' => 'Pegawai harus dipilih',
            'karyawan_id.unique' => 'Absensi pegawai pada tanggal ini sudah ada',
            'tanggal.required' => 'Tanggal harus diisi',
            'status_absensi.required' => 'Status absensi harus dipilih',
            'waktu_keluar.after' => 'Waktu keluar harus setelah waktu masuk',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil ditambahkan');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['employee.jabatan', 'employee.departemen']);
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::with('jabatan')->orderBy('nama_lengkap')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                'exists:employees,id',
                Rule::unique('attendance')->where(function ($query) use ($request) {
                    return $query->where('karyawan_id', $request->karyawan_id)
                                ->whereDate('tanggal', $request->tanggal);
                })->ignore($attendance->id)
            ],
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'karyawan_id.required' => 'Pegawai harus dipilih',
            'karyawan_id.unique' => 'Absensi pegawai pada tanggal ini sudah ada',
            'tanggal.required' => 'Tanggal harus diisi',
            'status_absensi.required' => 'Status absensi harus dipilih',
            'waktu_keluar.after' => 'Waktu keluar harus setelah waktu masuk',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui');
    }

    public function destroy(Attendance $attendance)
    {
        $employeeName = $attendance->employee->nama_lengkap;
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', "Data absensi $employeeName berhasil dihapus");
    }
}