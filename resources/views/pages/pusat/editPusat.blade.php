@extends('layouts.app')
@section('title', 'Ubah Pusat')
@section('content')
    @if (auth()->user()->role == 'admin' && auth()->user()->id == $pusat->pemilik_id)
        <x-common.page-breadcrumb pageTitle="Ubah Pusat" :breadcrumbs="[['label' => 'Pusat Saya', 'url' => route('pusats.show', $pusat->id)]]" />
    @else
        <x-common.page-breadcrumb pageTitle="Ubah Pusat" :breadcrumbs="[
            ['label' => 'Daftar Pusat Saya', 'url' => route('pemilik.pusats.index')],
            ['label' => 'Detail Pusat', 'url' => route('pemilik.pusats.show', $pusat->id)],
        ]" />
    @endif
    <div class="flex justify-center w-full">
        <div class="w-full sm:w-8/12">
            <x-common.component-card title="Ubah Pusat">
                <form action="{{ route('pusats.update', $pusat->id) }}" method="POST" class="grid gap-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Pusat
                        </label>
                        <input type="text" placeholder="Masukkan Nama Pusat" name="nama_pusat"
                            value="{{ $pusat->nama_pusat }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('nama_pusat')
                     border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('nama_pusat')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Alamat
                        </label>
                        <textarea placeholder="Masukkan Alamat" type="text" rows="6" name="alamat"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                        @error('alamat')
                         border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                        @else
                        focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 dark:border-gray-700
                        @enderror
                        ">{{ $pusat->alamat }}</textarea>
                        @error('alamat')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pemilik
                        </label>
                        <select name="pemilik_id"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                            @error('pemilik_id')
                             border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                            @else
                            focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                            @enderror
                            ">
                            <option value="" disabled selected>Pilih Pemilik</option>
                            @foreach ($pemiliks as $pemilik)
                                <option value="{{ $pemilik->id }}"
                                    {{ $pusat->pemilik_id == $pemilik->id ? 'selected' : '' }}>
                                    {{ $pemilik->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kota
                        </label>
                        <select name="kota_id"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                            @error('kota_id')
                             border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                            @else
                            focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                            @enderror
                            ">
                            <option value="" disabled selected>Pilih Kota</option>
                            @foreach ($kotas as $kota)
                                <option value="{{ $kota->id }}" {{ $pusat->kota_id == $kota->id ? 'selected' : '' }}>
                                    {{ $kota->nama_kota }}, {{ $kota->provinsi->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Simpan"
                        class="cursor-pointer rounded-lg bg-brand-600 px-6 py-3 text-sm font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-3 focus:ring-brand-500/20" />
                </form>
            </x-common.component-card>
        </div>
    </div>
@endsection
