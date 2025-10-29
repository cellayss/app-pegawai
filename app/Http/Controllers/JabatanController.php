<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::withCount('employees')->get();
        return view('positions.index', compact('jabatans'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil ditambahkan!');
    }

    // ✅ UBAH: Jabatan $jabatan → string $id
    public function show(string $id)
    {
        $jabatan = Jabatan::with('employees')->findOrFail($id);
        return view('positions.show', compact('jabatan'));
    }

    // ✅ UBAH: Jabatan $jabatan → string $id
    public function edit(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('positions.edit', compact('jabatan'));
    }

    // ✅ UBAH: Jabatan $jabatan → string $id
    public function update(Request $request, string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $jabatan->update($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil diupdate!');
    }

    // ✅ UBAH: Jabatan $jabatan → string $id
    public function destroy(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        
        // Cek apakah ada pegawai yang menggunakan jabatan ini
        if ($jabatan->employees()->count() > 0) {
            return redirect()->route('positions.index')
                ->with('error', 'Jabatan tidak dapat dihapus karena masih digunakan oleh ' . $jabatan->employees()->count() . ' pegawai!');
        }

        $jabatan->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil dihapus!');
    }
}