@extends('layouts.app')
@section('title', 'Detail Pusat')
@section('content')
    @if (auth()->user()->role == 'admin' && auth()->user()->id == $pusat->pemilik_id)
        <x-common.page-breadcrumb pageTitle="Pusat Saya" />
    @else
        <x-common.page-breadcrumb pageTitle="Detail Pusat" :breadcrumbs="[['label' => 'Daftar Pusat', 'url' => route('pusats.index')]]" />
    @endif
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">Detail Pusat</h3>
        <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div>

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-7 2xl:gap-x-32">
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama Pusat</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $pusat->nama_pusat ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Alamat</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $pusat->alamat ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Nama Pemilik
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $pusat->pemilik->name ?? '-' }} (id = {{ $pusat->pemilik->id ?? '-' }})
                            </p>
                            </p>
                        </div>

                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama Kota</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $pusat->kota->nama_kota ?? '-' }}, {{ $pusat->kota->provinsi->nama_provinsi ?? '-' }}</p>
                        </div>

                    </div>
                </div>
                @can('update', $pusat)
                    <a href="{{ route('pusats.edit', $pusat->id) }}">
                        <button class="edit-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Edit
                        </button>
                    </a>
                @endcan
                @can('delete', $pusat)
                    <button class="delete-button" @click="$dispatch('open-delete-modal', {{ $pusat->id }})"">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                            <path fill="currentColor"
                                d="M11.5-.031c-1.958 0-3.531 1.627-3.531 3.594V4H4c-.551 0-1 .449-1 1v1H2v2h2v15c0 1.645 1.355 3 3 3h12c1.645 0 3-1.355 3-3V8h2V6h-1V5c0-.551-.449-1-1-1h-3.969v-.438c0-1.966-1.573-3.593-3.531-3.593zm0 2.062h3c.804 0 1.469.656 1.469 1.531V4H10.03v-.438c0-.875.665-1.53 1.469-1.53zM6 8h5.125c.124.013.247.031.375.031h3c.128 0 .25-.018.375-.031H20v15c0 .563-.437 1-1 1H7c-.563 0-1-.437-1-1zm2 2v12h2V10zm4 0v12h2V10zm4 0v12h2V10z" />
                        </svg>
                        Hapus
                    </button>
                @endcan
            </div>
            @if ($pusat->fnbs->isNotEmpty())
                <div x-data="{
                    fnbs: [
                        @foreach ($pusat->fnbs as $fnb)
                        {
                            'id': '{{ $fnb->id }}',
                            'nama_fnb': '{{ $fnb->nama_fnb }}',
                            'harga': '{{ $fnb->pivot->harga }}',
                            'deskripsi': '{{ $fnb->deskripsi }}',
                            'foto_fnb': '{{ $fnb->foto_fnb }}',
                        }, @endforeach
                    ],
                }">
            @endif
            <a href="{{ route('pusats.addFnb', $pusat->id) }}">
                <x-ui.button class="mt-10">
                    Ubah Daftar Makanan / Minuman
                </x-ui.button>
            </a>
            <a href="{{ route('mejas.viewAll', $pusat->id) }}">
                <x-ui.button class="mt-10 ml-3" variant="primary">
                    Lihat Meja
                </x-ui.button>
            </a>
            <div
                class="mt-5 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[1102px]">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Nama Makanan / Minuman
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Harga
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Deskripsi
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Foto Fnb
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pusat->fnbs->isEmpty())
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td colspan="4" class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400 text-center">Tidak
                                            Ada Makanan / Minuman</p>
                                    </td>
                                </tr>
                            @else
                                <template x-for="fnb in fnbs" :key="fnb.id">
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400" x-text="fnb.nama_fnb">
                                            </p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400" x-text="fnb.harga">
                                            </p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400"
                                                x-text="fnb.deskripsi"></p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <template x-if="fnb.foto_fnb">
                                                <img :src="`/storage/${fnb.foto_fnb}`" alt="Foto Fnb"
                                                    class="h-16 w-16 rounded-lg object-cover" />
                                            </template>
                                            <template x-if="!fnb.foto_fnb">
                                                <div
                                                    class="flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-800">
                                                    <span class="text-gray-500 dark:text-gray-400 p-3 text-nowrap">No
                                                        Image</span>
                                                </div>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{
        open: false,
        transactionId: null
    }"
        x-on:open-delete-modal.window="
        open = true;
        transactionId = $event.fnbs.id;
    " x-show="open"
        x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-white/30">
        <!-- Modal box -->
        <div @click.outside="open = false" class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Hapus Pusat
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Apakah anda yakin ingin menghapus pusat ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button @click="open = false"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                    Cancel
                </button>

                <form :action="{{ route('pusats.destroy', $pusat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
