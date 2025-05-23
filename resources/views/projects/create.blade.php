@extends('layouts.app')

@section('content')
  <style>
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

  <div class="relative py-12 px-4 sm:px-6 lg:px-8 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl w-full">
      <div class="mb-10 animate-fade-in-up" style="animation: fadeInUp 0.6s ease-out;">
        <img src="{{ asset('assets/images/fli-logo.svg') }}" class="h-20 mb-4">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2 leading-tight">Leadership Project Submission</h1>
        <p class="text-gray-600">Persiapkan ide kamu dengan baik. Ide proyek yang telah di-submit pada Formulir
          ini adalah proyek final kamu yang akan dinilai pada seleksi Future Leaders ID.</p>
      </div>

      <form id="projectForm" action="{{ route('project.store') }}" method="POST"
        class="bg-white shadow-2xl rounded-xl p-8 space-y-6 animate-fade-in-up transform transition-all duration-300 hover:scale-[1.005]"
        style="animation: fadeInUp 0.8s ease-out;">
        @csrf

        <div>
          <label for="title" class="block text-sm font-semibold text-gray-800 mb-1">Judul Proyek</label>
          <input type="text" name="title" id="title" value="{{ old('title') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                        @error('title') border-red-500 @enderror"
            placeholder="Contoh: Pemberdayaan UMKM Berbasis Digital">
          @error('title')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-800 mb-1">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                        @error('email') border-red-500 @enderror"
              placeholder="Contoh: budi@example.com">
            @error('email')
              <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="phone" class="block text-sm font-semibold text-gray-800 mb-1">Nomor HP</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                        @error('phone') border-red-500 @enderror"
              placeholder="Contoh: 081234567890">
            @error('phone')
              <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div>
          <label for="description" class="block text-sm font-semibold text-gray-800 mb-1">Deskripsi Proyek</label>
          <textarea name="description" id="description" rows="4" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('description') border-red-500 @enderror"
            placeholder="Jelaskan tujuan, aktivitas, dan dampak proyek Anda.">{{ old('description') }}</textarea>
          @error('description')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="name" class="block text-sm font-semibold text-gray-800 mb-1">Nama Lengkap (Ketua
            Proyek)</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                        @error('name') border-red-500 @enderror"
            placeholder="Contoh: Budi Santoso">
          @error('name')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="team_members" class="block text-sm font-semibold text-gray-800 mb-1">Anggota Tim (Jika Ada)</label>
          <textarea name="team_members" id="team_members" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('team_members') border-red-500 @enderror"
            placeholder="Contoh: Ani (Keuangan), Dedi (Teknis)">{{ old('team_members') }}</textarea>
          @error('team_members')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="problems" class="block text-sm font-semibold text-gray-800 mb-1">Permasalahan yang Ingin
            Diselesaikan</label>
          <textarea name="problems" id="problems" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('problems') border-red-500 @enderror"
            placeholder="Contoh: Minimnya akses literasi digital di daerah terpencil.">{{ old('problems') }}</textarea>
          @error('problems')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="solutions" class="block text-sm font-semibold text-gray-800 mb-1">Solusi yang Ditawarkan</label>
          <textarea name="solutions" id="solutions" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('solutions') border-red-500 @enderror"
            placeholder="Jelaskan solusi inovatif yang Anda rancang untuk mengatasi permasalahan tersebut.">{{ old('solutions') }}</textarea>
          @error('solutions')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="target_beneficiaries" class="block text-sm font-semibold text-gray-800 mb-1">Penerima
            Manfaat</label>
          <textarea name="target_beneficiaries" id="target_beneficiaries" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('target_beneficiaries') border-red-500 @enderror"
            placeholder="Contoh: Pelajar SMA di desa X, komunitas ibu rumah tangga di kota Y.">{{ old('target_beneficiaries') }}</textarea>
          @error('target_beneficiaries')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="unique_value" class="block text-sm font-semibold text-gray-800 mb-1">Nilai Unik Proyek</label>
          <textarea name="unique_value" id="unique_value" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('unique_value') border-red-500 @enderror"
            placeholder="Apa yang membuat proyek ini berbeda dan menonjol dari yang lain?">{{ old('unique_value') }}</textarea>
          @error('unique_value')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="key_features" class="block text-sm font-semibold text-gray-800 mb-1">Kegiatan Utama / Rencana
            Aksi</label>
          <textarea name="key_features" id="key_features" rows="3"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('key_features') border-red-500 @enderror"
            placeholder="Contoh: Workshop literasi digital, mentoring berkala, kolaborasi dengan sekolah dan perangkat desa.">{{ old('key_features') }}</textarea>
          @error('key_features')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="funding_needs" class="block text-sm font-semibold text-gray-800 mb-1">Kebutuhan Dana (Jika
            Ada)</label>
          <textarea name="funding_needs" id="funding_needs" rows="2"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base
                    @error('funding_needs') border-red-500 @enderror"
            placeholder="Tuliskan estimasi dana yang dibutuhkan dan alokasinya (misal: operasional, bahan baku, pemasaran).">{{ old('funding_needs') }}</textarea>
          @error('funding_needs')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <button type="submit" id="submitBtn"
            class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-lg text-base font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-[1.01]">
            <span id="submitText">Kirim Proyek</span>
            <svg id="loadingIcon" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
              </circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('projectForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingIcon = document.getElementById('loadingIcon');

    form.addEventListener('submit', function() {
      submitBtn.disabled = true;
      submitText.textContent = 'Mengirim...';
      loadingIcon.classList.remove('hidden');
    });
  </script>
@endsection
