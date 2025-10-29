@extends('master')
@section('title', 'Detail Gaji')
@section('page-title', 'Detail Gaji')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('salaries.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Gaji
        </a>
    </div>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-pink-400 to-rose-400 rounded-xl shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-2xl">
                        {{ strtoupper(substr($salary->employee->nama_lengkap, 0, 2)) }}
                    </span>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">{{ $salary->employee->nama_lengkap }}</h2>
                    <p class="text-pink-100 mt-1">{{ $salary->employee->jabatan->nama_jabatan ?? '-' }}</p>
                    <div class="flex items-center mt-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">Periode: {{ \Carbon\Carbon::parse($salary->bulan . '-01')->format('F Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <p class="text-pink-100 text-sm mb-1">Total Gaji</p>
                <p class="text-4xl font-bold">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Information -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-6 py-4">
            <h3 class="text-xl font-bold text-white">Detail Informasi</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Employee Information -->
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-800 text-lg mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Pegawai
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Nama Lengkap</span>
                            <span class="font-semibold text-gray-800">{{ $salary->employee->nama_lengkap }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Jabatan</span>
                            <span class="font-semibold text-gray-800">{{ $salary->employee->jabatan->nama_jabatan ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Departemen</span>
                            <span class="font-semibold text-gray-800">{{ $salary->employee->departemen->nama_departemen ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Salary Breakdown -->
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-800 text-lg mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Rincian Gaji
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Periode</span>
                            <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($salary->bulan . '-01')->format('F Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Gaji Pokok</span>
                            <span class="font-semibold text-gray-800">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Tunjangan</span>
                            <span class="font-semibold text-green-600">+ Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Potongan</span>
                            <span class="font-semibold text-red-600">- Rp {{ number_format($salary->potongan, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 bg-gradient-to-r from-pink-50 to-rose-50 px-4 rounded-lg mt-2">
                            <span class="font-bold text-gray-800">Total Gaji</span>
                            <span class="font-bold text-emerald-600 text-xl">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info if exists -->
            @if($salary->keterangan)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Keterangan
                </h4>
                <p class="text-gray-600">{{ $salary->keterangan }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('salaries.edit', $salary->id) }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 text-white font-semibold rounded-xl hover:bg-yellow-600 shadow-lg hover:shadow-xl transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Gaji
        </a>
        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin ingin menghapus data gaji {{ $salary->employee->nama_lengkap }} periode {{ \Carbon\Carbon::parse($salary->bulan . '-01')->format('F Y') }}?')" class="inline-flex items-center px-6 py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 shadow-lg hover:shadow-xl transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Gaji
            </button>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .space-y-6 > * {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection