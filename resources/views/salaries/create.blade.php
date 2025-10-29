@extends('master')
@section('title', 'Tambah Gaji')
@section('page-title', 'Tambah Gaji')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('salaries.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Gaji
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-8 py-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Tambah Data Gaji</h2>
                    <p class="text-pink-100 text-sm mt-1">Isi form di bawah untuk menambahkan data gaji pegawai</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('salaries.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

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

            <!-- Pilih Karyawan -->
            <div>
                <label for="karyawan_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Pegawai <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <select 
                        id="karyawan_id" 
                        name="karyawan_id" 
                        required
                        onchange="updateGajiPokok()"
                        class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('karyawan_id') border-red-300 @enderror">
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" 
                                    data-gaji="{{ $employee->jabatan->gaji_pokok ?? 0 }}" 
                                    {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->nama_lengkap }} - {{ $employee->jabatan->nama_jabatan ?? 'Tanpa Jabatan' }}
                            </option>
                        @endforeach
                    </select>
                    @error('karyawan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Pilih pegawai yang akan diberikan gaji</p>
            </div>

            <!-- Periode (Bulan) -->
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">
                    Periode (Bulan) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input 
                        type="month" 
                        id="bulan" 
                        name="bulan" 
                        value="{{ old('bulan', date('Y-m')) }}"
                        required
                        class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('bulan') border-red-300 @enderror">
                    @error('bulan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Pilih bulan dan tahun untuk periode gaji</p>
            </div>

            <!-- Gaji Pokok (Auto-filled dari Jabatan) -->
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
                        value="{{ old('gaji_pokok') }}"
                        readonly
                        class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-50 cursor-not-allowed text-gray-600 font-semibold focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('gaji_pokok') border-red-300 @enderror"
                        placeholder="Pilih pegawai terlebih dahulu">
                    @error('gaji_pokok')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Gaji otomatis terisi sesuai jabatan pegawai yang dipilih</p>
            </div>

            <!-- Tunjangan -->
            <div>
                <label for="tunjangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Tunjangan <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-medium">Rp</span>
                    </div>
                    <input 
                        type="number" 
                        id="tunjangan" 
                        name="tunjangan" 
                        value="{{ old('tunjangan', 0) }}"
                        min="0"
                        step="1000"
                        class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('tunjangan') border-red-300 @enderror"
                        placeholder="0">
                    @error('tunjangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Contoh: Tunjangan transport, makan, dll</p>
            </div>

            <!-- Potongan -->
            <div>
                <label for="potongan" class="block text-sm font-medium text-gray-700 mb-2">
                    Potongan <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-medium">Rp</span>
                    </div>
                    <input 
                        type="number" 
                        id="potongan" 
                        name="potongan" 
                        value="{{ old('potongan', 0) }}"
                        min="0"
                        step="1000"
                        class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('potongan') border-red-300 @enderror"
                        placeholder="0">
                    @error('potongan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-1 text-xs text-gray-500">Contoh: Potongan BPJS, pinjaman, dll</p>
            </div>

            <!-- Preview Total Gaji -->
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-emerald-600 font-medium">Total Gaji</p>
                            <p class="text-2xl font-bold text-emerald-700" id="total-gaji">Rp 0</p>
                        </div>
                    </div>
                    <div class="text-right text-xs text-emerald-600">
                        <p>= Gaji Pokok + Tunjangan - Potongan</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('salaries.index') }}" 
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-rose-500 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Data Gaji
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Update gaji pokok otomatis saat pilih pegawai
    function updateGajiPokok() {
        const select = document.getElementById('karyawan_id');
        const gajiInput = document.getElementById('gaji_pokok');
        
        const selectedOption = select.options[select.selectedIndex];
        const gajiPokok = selectedOption.getAttribute('data-gaji');
        
        if (gajiPokok) {
            gajiInput.value = gajiPokok;
            gajiInput.placeholder = 'Rp ' + parseFloat(gajiPokok).toLocaleString('id-ID');
        } else {
            gajiInput.value = '';
            gajiInput.placeholder = 'Pilih pegawai terlebih dahulu';
        }
        
        // Hitung ulang total
        hitungTotalGaji();
    }

    // Hitung total gaji secara real-time
    function hitungTotalGaji() {
        const gajiPokok = parseFloat(document.getElementById('gaji_pokok').value) || 0;
        const tunjangan = parseFloat(document.getElementById('tunjangan').value) || 0;
        const potongan = parseFloat(document.getElementById('potongan').value) || 0;
        
        const total = gajiPokok + tunjangan - potongan;
        
        // Format dengan titik sebagai pemisah ribuan
        const formatted = total.toLocaleString('id-ID');
        document.getElementById('total-gaji').textContent = 'Rp ' + formatted;
    }

    // Event listeners
    document.getElementById('gaji_pokok').addEventListener('input', hitungTotalGaji);
    document.getElementById('tunjangan').addEventListener('input', hitungTotalGaji);
    document.getElementById('potongan').addEventListener('input', hitungTotalGaji);

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('karyawan_id');
        if (select.value) {
            updateGajiPokok();
        }
        hitungTotalGaji();
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