@extends('master')
@section('title', 'Edit Departemen')
@section('page-title', 'Edit Departemen')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('departemens.index') }}" 
               class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Departemen
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
                        <h2 class="text-2xl font-bold text-white">Edit Departemen</h2>
                        <p class="text-pink-100 text-sm mt-1">Perbarui informasi departemen</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <form action="{{ route('departemens.update', $departemen->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-blue-800 font-medium">Informasi Departemen</p>
                                <p class="text-xs text-blue-600 mt-1">ID: <span class="font-semibold">{{ $departemen->id }}</span></p>
                                <p class="text-xs text-blue-600">Dibuat: <span class="font-semibold">{{ $departemen->created_at->format('d M Y H:i') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Departemen -->
                    <div>
                        <label for="nama_departemen" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Departemen <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="nama_departemen" 
                                   name="nama_departemen" 
                                   value="{{ old('nama_departemen', $departemen->nama_departemen) }}" 
                                   required
                                   class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('nama_departemen') border-red-300 bg-red-50 @enderror"
                                   placeholder="Contoh: Human Resources, IT Department, Marketing">
                        </div>
                        @error('nama_departemen')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Masukkan nama departemen yang jelas dan mudah diidentifikasi</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-8 mt-8 border-t-2 border-gray-100">
                    <a href="{{ route('departemens.index') }}" 
                       class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-2.5 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-rose-500 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection