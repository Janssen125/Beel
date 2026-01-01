@extends('layouts.app')
@section('title', 'Ubah Makanan / Minuman')
@section('content')
    <x-common.page-breadcrumb pageTitle="Ubah Makanan / Minuman" :breadcrumbs="[['label' => 'Daftar Makanan & Minuman', 'url' => route('fnbs.index')]]" />
    <div class="flex justify-center w-full">
        <div class="w-full sm:w-8/12">
            <x-common.component-card title="Ubah Makanan / Minuman">
                <form action="{{ route('fnbs.update', $fnb->id) }}" method="POST" enctype="multipart/form-data"
                    class="grid gap-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Makanan / Minuman
                        </label>
                        <input type="text" placeholder="Masukkan Nama Makanan / Minuman" name="nama_fnb"
                            value="{{ $fnb->nama_fnb }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('nama_fnb')
                     border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('nama_fnb')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga
                        </label>
                        <input type="number" placeholder="Masukkan Harga (cth: 10000)" name="harga"
                            value="{{ $fnb->harga }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('harga')
                        border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('harga')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Deskripsi
                        </label>
                        <textarea placeholder="Masukkan Deskripsi" type="text" rows="6" name="deskripsi"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border  bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                        @error('deskripsi')
                         border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                        @else
                        focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 dark:border-gray-700
                        @enderror
                        ">{{ $fnb->deskripsi }}</textarea>
                        @error('deskripsi')
                            <p class="text-theme-xs text-error-500 mt-1.5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Foto Makanan / Minuman
                        </label>
                        <input type="file" name="foto_fnb"
                            @error('foto_fnb')
                            class="focus:border-ring-error-300 shadow-theme-xs focus:file:ring-error-300 h-11 w-full overflow-hidden rounded-lg border border-error-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-error-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400"
                        @else
                            class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400"
                            @enderror />
                        @error('foto_fnb')
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
