@extends('master')
@section('title', 'Edit Jabatan')
@section('page-title', 'Edit Jabatan')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('positions.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Jabatan
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
                    <h2 class="text-2xl font-bold text-white">Edit Jabatan</h2>
                    <p class="text-pink-100 text-sm mt-1">Perbarui informasi jabatan {{ $jabatan->nama_jabatan }}</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('positions.update', $jabatan->id) }}" method="POST" class="p-8 space-y-6">
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
                            <span class="font-semibold">Jabatan:</span> {{ $jabatan->nama_jabatan }} | 
                            <span class="font-semibold">Gaji:</span> Rp {{ number_format($jabatan->gaji_pokok, 0, ',', '.') }} | 
                            <span class="font-semibold">Pegawai:</span> {{ $jabatan->employees->count() }} orang
                        </p>
                    </div>
                </div>
            </div>

            <!-- Nama Jabatan -->
            <div>
                <label for="nama_jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Jabatan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="nama_jabatan" 
                        name="nama_jabatan" 
                        value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                        required
                        maxlength="100"
                        class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('nama_jabatan') border-red-300 @enderror"
                        placeholder="Contoh: Manajer HRD, Staff IT, Direktur">
                    @error('nama_jabatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Maksimal 100 karakter</p>
            </div>

            <!-- Gaji Pokok -->
            <div>
                <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-2">
                    Gaji Pokok <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-medium">Rp</span>
                    </div>
                    <input 
                        type="number" 
                        id="gaji_pokok" 
                        name="gaji_pokok" 
                        value="{{ old('gaji_pokok', $jabatan->gaji_pokok) }}"
                        required
                        min="0"
                        step="1000"
                        class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('gaji_pokok') border-red-300 @enderror"
                        placeholder="5000000"
                        oninput="formatCurrency(this)">
                    @error('gaji_pokok')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Masukkan nominal tanpa titik atau koma</p>
                
                <!-- Preview Gaji -->
                <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm text-green-700">
                            <span class="font-medium">Preview:</span> 
                            <span id="preview-gaji" class="font-bold">Rp {{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('positions.show', $jabatan->id) }}" 
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-rose-500 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Jabatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Format currency with dots
    function formatCurrency(input) {
        const value = input.value.replace(/\D/g, '');
        const formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Update preview
        const previewElement = document.getElementById('preview-gaji');
        if (value) {
            previewElement.textContent = 'Rp ' + formatted;
        } else {
            previewElement.textContent = 'Rp 0';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const gajiInput = document.getElementById('gaji_pokok');
        if (gajiInput.value) {
            formatCurrency(gajiInput);
        }
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

    /* Remove spinner from number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection