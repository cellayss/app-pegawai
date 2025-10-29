@extends('master')
@section('title', 'Edit Pegawai')
@section('page-title', 'Edit Pegawai')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 to-rose-200 py-10">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-pink-500 to-rose-400 p-6 flex items-center gap-4">
            <div class="bg-white text-pink-500 font-bold text-3xl w-20 h-20 flex items-center justify-center rounded-2xl shadow-md">
                {{ strtoupper(substr($employee->nama_lengkap, 0, 2)) }}
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-white">{{ $employee->nama_lengkap }}</h1>
                <p class="text-pink-100">{{ $employee->email }}</p>
                <span class="inline-flex items-center mt-2 text-sm bg-green-100 text-green-700 font-semibold px-3 py-1 rounded-full">
                    ● {{ ucfirst($employee->status) }}
                </span>
            </div>
        </div>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            {{-- Informasi Pribadi --}}
            <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <span class="text-pink-500"><i class="fas fa-user"></i></span> Informasi Pribadi
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600">Alamat</label>
                    <textarea name="alamat" rows="2" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">{{ old('alamat', $employee->alamat) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Status</label>
                    <select name="status" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                        <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $employee->status == 'nonaktif' ? 'selected' : '' }}>NonAktif</option>
                    </select>
                </div>
            </div>

            {{-- Informasi Kepegawaian --}}
            <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <span class="text-rose-500"><i class="fas fa-briefcase"></i></span> Informasi Kepegawaian
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Departemen</label>
                    <select name="departemen_id" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departemens as $departemen)
                            <option value="{{ $departemen->id }}" {{ $employee->departemen_id == $departemen->id ? 'selected' : '' }}>
                                {{ $departemen->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Jabatan</label>
                    <select name="jabatan_id" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $jab)
                            <option value="{{ $jab->id }}" {{ $employee->jabatan_id == $jab->id ? 'selected' : '' }}>
                                {{ $jab->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" class="w-full mt-1 rounded-lg border-gray-300 focus:ring-pink-400 focus:border-pink-400">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('employees.show', $employee->id) }}" class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 rounded-lg bg-pink-500 text-white hover:bg-pink-600 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
