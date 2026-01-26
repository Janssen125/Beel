@extends('layouts.app')
@section('title', 'Buat Transaksi Baru')
@section('content')

    @if (auth()->user()->role == 'staff')
        <x-common.page-breadcrumb pageTitle="Buat Transaksi Baru" :breadcrumbs="[['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $meja->pusat_id)]]" />
    @elseif(auth()->user()->role == 'admin')
        <x-common.page-breadcrumb pageTitle="Buat Transaksi Baru" :breadcrumbs="[
            ['label' => 'Pusat Saya', 'url' => route('pusats.show', $meja->pusat_id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $meja->pusat_id)],
        ]" />
    @elseif(auth()->user()->role == 'superadmin')
        <x-common.page-breadcrumb pageTitle="Buat Transaksi Baru" :breadcrumbs="[
            ['label' => 'Daftar Pusat', 'url' => route('pusats.index')],
            ['label' => 'Detail Pusat', 'url' => route('pusats.show', $meja->pusat_id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $meja->pusat_id)],
        ]" />
    @endif
    <div class="flex justify-center w-full">
        <div class="w-full sm:w-8/12">
            <x-common.component-card title="Buat Transaksi Baru">
                <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data"
                    class="grid gap-6">
                    @csrf
                    {{-- honestly not secured, should have done it at backend --}}
                    <input type="hidden" name="pusat_id" value="{{ $meja->pusat_id }}">
                    <input type="hidden" name="staff_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="redirect_to" value="{{ route('mejas.viewAll', $meja->pusat_id) }}">

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nomor Meja
                        </label>
                        <input type="text" name="nomor_meja" value="{{ $meja->nomor_meja }}" readonly
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
                            Nama Customer
                        </label>
                        <input type="text" placeholder="Masukkan Nama Customer" name="nama_customer"
                            value="{{ old('nama_customer') }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                    @error('nama_customer')
                        border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                    @else
                    focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                    @enderror
                    " />
                        @error('nama_customer')
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
