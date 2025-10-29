@extends('master')
@section('title', 'Edit Absensi')
@section('page-title', 'Edit Absensi')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('attendances.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Absensi
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-8 py-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Edit Absensi</h2>
                    <p class="text-pink-100 text-sm mt-1">Perbarui informasi absensi {{ $attendance->employee->nama_lengkap }}</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Info Box - Current Data -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800 mb-1">Data Saat Ini:</h3>
                        <p class="text-sm text-blue-700">
                            <span class="font-semibold">Pegawai:</span> {{ $attendance->employee->nama_lengkap }} | 
                            <span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }} | 
                            <span class="font-semibold">Status:</span> {{ ucfirst($attendance->status_absensi) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pegawai -->
                <div>
                    <label for="karyawan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pegawai <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <select name="karyawan_id" id="karyawan_id" required
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('karyawan_id') border-red-300 @enderror">
                            <option value="">Pilih Pegawai</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('karyawan_id', $attendance->karyawan_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->nama_lengkap }} - {{ $employee->jabatan->nama_jabatan ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('karyawan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="date" name="tanggal" id="tanggal" 
                            value="{{ old('tanggal', $attendance->tanggal) }}"
                            required
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('tanggal') border-red-300 @enderror">
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status Absensi -->
                <div>
                    <label for="status_absensi" class="block text-sm font-medium text-gray-700 mb-2">
                        Status Absensi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <select name="status_absensi" id="status_absensi" required
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('status_absensi') border-red-300 @enderror"
                            onchange="toggleTimeFields()">
                            <option value="">Pilih Status</option>
                            <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                        @error('status_absensi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Pilih status kehadiran pegawai</p>
                </div>

                <!-- Placeholder for alignment -->
                <div></div>

                <!-- Waktu Masuk -->
                <div id="waktu_masuk_field">
                    <label for="waktu_masuk" class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Masuk
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="time" name="waktu_masuk" id="waktu_masuk" 
                            value="{{ old('waktu_masuk', $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '') }}"
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('waktu_masuk') border-red-300 @enderror">
                        @error('waktu_masuk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Opsional untuk status hadir</p>
                </div>

                <!-- Waktu Keluar -->
                <div id="waktu_keluar_field">
                    <label for="waktu_keluar" class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Keluar
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="time" name="waktu_keluar" id="waktu_keluar" 
                            value="{{ old('waktu_keluar', $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '') }}"
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('waktu_keluar') border-red-300 @enderror">
                        @error('waktu_keluar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Opsional untuk status hadir</p>
                </div>
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <div class="relative">
                    <div class="absolute top-3 left-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <textarea name="keterangan" id="keterangan" rows="4"
                        class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('keterangan') border-red-300 @enderror"
                        placeholder="Tambahkan catatan atau alasan (opsional)...">{{ old('keterangan', $attendance->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('attendances.show', $attendance->id) }}" 
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-rose-500 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Absensi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle waktu masuk/keluar berdasarkan status
    function toggleTimeFields() {
        const status = document.getElementById('status_absensi').value;
        const waktuMasukField = document.getElementById('waktu_masuk_field');
        const waktuKeluarField = document.getElementById('waktu_keluar_field');
        const waktuMasukInput = document.getElementById('waktu_masuk');
        const waktuKeluarInput = document.getElementById('waktu_keluar');
        
        if (status === 'hadir') {
            waktuMasukField.style.display = 'block';
            waktuKeluarField.style.display = 'block';
        } else {
            waktuMasukField.style.display = 'none';
            waktuKeluarField.style.display = 'none';
            waktuMasukInput.value = '';
            waktuKeluarInput.value = '';
        }
    }

    // Initial toggle on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleTimeFields();
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .bg-white {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection