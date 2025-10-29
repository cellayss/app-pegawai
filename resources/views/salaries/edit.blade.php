@extends('master')
@section('title', 'Edit Gaji')
@section('page-title', 'Edit Gaji')

@section('content')
<div class="max-w-4xl mx-auto">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Edit Gaji</h2>
                    <p class="text-pink-100 text-sm mt-1">Perbarui informasi gaji {{ $salary->employee->nama_lengkap }}</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="p-8 space-y-6">
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
                            <span class="font-semibold">Pegawai:</span> {{ $salary->employee->nama_lengkap }} | 
                            <span class="font-semibold">Periode:</span> {{ \Carbon\Carbon::parse($salary->bulan . '-01')->format('F Y') }} | 
                            <span class="font-semibold">Total:</span> Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pegawai -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Pegawai <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <select name="employee_id" id="employee_id" required
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('employee_id') border-red-300 @enderror">
                            <option value="">Pilih Pegawai</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" 
                                    {{ old('employee_id', $salary->employee_id) == $employee->id ? 'selected' : '' }}
                                    data-gaji="{{ $employee->jabatan->gaji_pokok ?? 0 }}">
                                    {{ $employee->nama_lengkap }} - {{ $employee->jabatan->nama_jabatan ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Periode (Bulan) -->
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">
                        Periode <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="month" name="bulan" id="bulan" 
                            value="{{ old('bulan', $salary->bulan) }}"
                            required
                            class="pl-10 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('bulan') border-red-300 @enderror">
                        @error('bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
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
                        <input type="number" name="gaji_pokok" id="gaji_pokok" 
                            value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                            min="0" step="1000" required
                            class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('gaji_pokok') border-red-300 @enderror"
                            placeholder="5000000">
                        @error('gaji_pokok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Terisi otomatis dari jabatan pegawai</p>
                </div>

                <!-- Tunjangan -->
                <div>
                    <label for="tunjangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Tunjangan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">Rp</span>
                        </div>
                        <input type="number" name="tunjangan" id="tunjangan" 
                            value="{{ old('tunjangan', $salary->tunjangan) }}"
                            min="0" step="1000"
                            class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('tunjangan') border-red-300 @enderror"
                            placeholder="0">
                        @error('tunjangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Potongan -->
                <div>
                    <label for="potongan" class="block text-sm font-medium text-gray-700 mb-2">
                        Potongan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">Rp</span>
                        </div>
                        <input type="number" name="potongan" id="potongan" 
                            value="{{ old('potongan', $salary->potongan) }}"
                            min="0" step="1000"
                            class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-200 focus:outline-none transition-all duration-200 @error('potongan') border-red-300 @enderror"
                            placeholder="0">
                        @error('potongan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Total Gaji -->
                <div>
                    <label for="total_gaji" class="block text-sm font-medium text-gray-700 mb-2">
                        Total Gaji
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">Rp</span>
                        </div>
                        <input type="text" id="total_gaji_display" readonly
                            value="{{ number_format($salary->total_gaji, 0, ',', '.') }}"
                            class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-700 font-bold">
                        <input type="hidden" name="total_gaji" id="total_gaji" value="{{ $salary->total_gaji }}">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Dihitung otomatis: Gaji Pokok + Tunjangan - Potongan</p>
                </div>
            </div>

            <!-- Preview Total -->
            <div class="p-4 bg-green-50 border-l-4 border-green-400 rounded-r-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm text-green-700">
                        <span class="font-medium">Preview Total Gaji:</span> 
                        <span id="preview-total" class="font-bold text-lg ml-2">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</span>
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('salaries.show', $salary->id) }}" 
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-rose-500 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Gaji
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto calculate total gaji
    function calculateTotal() {
        const gajiPokok = parseFloat(document.getElementById('gaji_pokok').value) || 0;
        const tunjangan = parseFloat(document.getElementById('tunjangan').value) || 0;
        const potongan = parseFloat(document.getElementById('potongan').value) || 0;
        
        const total = gajiPokok + tunjangan - potongan;
        
        document.getElementById('total_gaji').value = total;
        document.getElementById('total_gaji_display').value = total.toLocaleString('id-ID');
        document.getElementById('preview-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Auto fill gaji pokok when employee selected
    document.getElementById('employee_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const gajiPokok = selectedOption.getAttribute('data-gaji');
        
        if (gajiPokok) {
            document.getElementById('gaji_pokok').value = gajiPokok;
            calculateTotal();
        }
    });

    // Calculate on input change
    document.getElementById('gaji_pokok').addEventListener('input', calculateTotal);
    document.getElementById('tunjangan').addEventListener('input', calculateTotal);
    document.getElementById('potongan').addEventListener('input', calculateTotal);

    // Initial calculation on page load
    document.addEventListener('DOMContentLoaded', calculateTotal);
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