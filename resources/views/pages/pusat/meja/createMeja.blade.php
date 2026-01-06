@extends('layouts.app')
@section('title', 'Tambah Meja')
@section('content')
    @if (auth()->user()->role == 'admin')
        <x-common.page-breadcrumb pageTitle="Tambah Meja" :breadcrumbs="[
            ['label' => 'Pusat Saya', 'url' => route('pusats.show', $pusat->id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $pusat->id)],
        ]" />
    @elseif(auth()->user()->role == 'superadmin')
        <x-common.page-breadcrumb pageTitle="Tambah Meja" :breadcrumbs="[
            ['label' => 'Daftar Pusat', 'url' => route('pusats.index')],
            ['label' => 'Detail Pusat', 'url' => route('pusats.show', $pusat->id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $pusat->id)],
        ]" />
    @endif
    <div class="flex justify-center w-full">
        <div class="w-full sm:w-8/12">
            <x-common.component-card title="Tambah Meja">
                <form action="{{ route('mejas.store') }}" method="POST" class="grid gap-6">
                    @csrf
                    <input type="hidden" name="pusat_id" value="{{ $pusat->id }}">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nomor Meja
                        </label>
                        <input type="text" placeholder="Masukkan Nomor Meja (cth: A1, Meja2, Table78, ...)"
                            name="nomor_meja" value="{{ old('nomor_meja') }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('nomor_meja')
                     border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('nomor_meja')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Jenis Meja
                        </label>
                        <select name="jenis_meja_id"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                            @error('jenis_meja_id')
                             border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                            @else
                            focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                            @enderror
                            ">
                            <option value="" disabled selected>Pilih Jenis Meja</option>
                            @foreach ($jenisMejas as $jenisMeja)
                                <option value="{{ $jenisMeja->id }}"
                                    {{ old('jenis_meja_id') == $jenisMeja->id ? 'selected' : '' }}>
                                    {{ $jenisMeja->nama_jenis_meja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga Per Jam
                        </label>
                        <input type="number" placeholder="Masukkan Harga Per Jam" name="harga_per_jam"
                            value="{{ old('harga_per_jam') }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('harga_per_jam')
                     border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('harga_per_jam')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <input type="submit" value="Simpan"
                        class="cursor-pointer rounded-lg bg-brand-600 px-6 py-3 text-sm font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-3 focus:ring-brand-500/20" />
                </form>
            </x-common.component-card>
        </div>
    </div>
@endsection
