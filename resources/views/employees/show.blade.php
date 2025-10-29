@extends('master')
@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('employees.index') }}" 
           class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Pegawai
        </a>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header with Gradient -->
        <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-8 py-12 relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative flex items-center">
                <!-- Avatar -->
                <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-lg mr-6">
                    <span class="text-4xl font-bold text-pink-500">
                        {{ strtoupper(substr($employee->nama_lengkap, 0, 2)) }}
                    </span>
                </div>
                
                <!-- Info -->
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $employee->nama_lengkap }}</h1>
                    <p class="text-pink-100 text-lg">{{ $employee->email }}</p>
                    <div class="flex items-center mt-3 space-x-3">
                        @if($employee->status == 'aktif')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-500 text-white">
                                <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-500 text-white">
                                <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                Non-Aktif
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 mb-8 pb-6 border-b-2 border-gray-100">
                <a href="{{ route('employees.edit', $employee->id) }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Data
                </a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Yakin ingin menghapus pegawai {{ $employee->nama_lengkap }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-5 py-2.5 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>

            <!-- Detail Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Informasi Pribadi -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-200 to-rose-200 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        Informasi Pribadi
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Nomor Telepon -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Nomor Telepon</p>
                                <p class="text-gray-800 font-semibold">{{ $employee->nomor_telepon }}</p>
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Tanggal Lahir</p>
                                <p class="text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Usia: {{ \Carbon\Carbon::parse($employee->tanggal_lahir)->age }} tahun
                                </p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Alamat</p>
                                <p class="text-gray-800">{{ $employee->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kepegawaian -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-rose-200 to-orange-200 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        Informasi Kepegawaian
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Departemen -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Departemen</p>
                                <p class="text-gray-800 font-semibold">{{ $employee->departemen->nama_departemen ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Jabatan</p>
                                <p class="text-gray-800 font-semibold">{{ $employee->jabatan->nama_jabatan ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Gaji Pokok -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-600 font-medium mb-1">Gaji Pokok</p>
                                <p class="text-gray-800 font-bold text-xl">
                                    Rp {{ number_format($employee->jabatan->gaji_pokok ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-600 mt-1">Per bulan</p>
                            </div>
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-medium mb-1">Tanggal Masuk</p>
                                <p class="text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Masa Kerja: {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->diffForHumans(['parts' => 2]) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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