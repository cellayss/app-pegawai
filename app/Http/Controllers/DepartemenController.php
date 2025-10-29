<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::withCount('employees')->latest()->paginate(10);
        return view('departemens.index', compact('departemens'));
    }

    public function create()
    {
        return view('departemens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen',
        ]);

        Departemen::create($request->all());

        return redirect()->route('departemens.index')
            ->with('success', 'Data departemen berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $departemen = Departemen::with('employees')->findOrFail($id);
        return view('departemens.show', compact('departemen'));
    }

    public function edit(string $id)
    {
        $departemen = Departemen::findOrFail($id);
        return view('departemens.edit', compact('departemen'));
    }

    public function update(Request $request, string $id)
    {
        $departemen = Departemen::findOrFail($id);

        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $id,
        ]);

        $departemen->update($request->all());

        return redirect()->route('departemens.index')
            ->with('success', 'Data departemen berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $departemen = Departemen::findOrFail($id);
        
        // Cek apakah departemen masih memiliki pegawai
        if ($departemen->employees()->count() > 0) {
            return redirect()->route('departemens.index')
                ->with('error', 'Departemen tidak dapat dihapus karena masih memiliki pegawai!');
        }
        
        $departemen->delete();

        return redirect()->route('departemens.index')
            ->with('success', 'Data departemen berhasil dihapus!');
    }
}