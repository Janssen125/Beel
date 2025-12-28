@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
    <x-common.page-breadcrumb pageTitle="Detail Transaksi" />
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">Detail Transaksi, ID =
            {{ $transaction->id }}</h3>
        <div x-data="{
            saveProfile() {
                    console.log('Saving profile...');
                },
                getStatusClass(status) {
                    const classes = {
                        'completed': 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                        'pending': 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                        'cancelled': 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                    };
                    return classes[status] || '';
                },
        }">
            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div>

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-7 2xl:gap-x-32">
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama Staff</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->staff->name ?? '-' }} (id = {{ $transaction->staff_id ?? '-' }})</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama Customer</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->nama_customer ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                    Nama Pusat
                                </p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->pusat->nama_pusat ?? '-' }} (id = {{ $transaction->pusat_id ?? '-' }})
                                </p>
                                </p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Status</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="getStatusClass('{{ $transaction->status }}')">{{ $transaction->status }}</span>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nomor Meja</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->nomor_meja ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Total Waktu</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->total_waktu ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Harga Per Jam</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->harga_per_jam ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Total Harga</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->total_harga ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <button class="edit-button" @click="$dispatch('open-delete-modal', {{ $transaction->id }})"">
                        <svg class="text-gray-700 cursor-pointer size-5 dark:text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>
                @if ($transaction->details->isNotEmpty())
                    <div x-data="{
                        details: [
                            @foreach ($transaction->details as $detail)
                        {
                            'id': 1,
                            'nama_fnb': '{{ $detail->nama_fnb }}',
                            'harga': '{{ $detail->harga }}',
                            'quantity': '{{ $detail->quantity }}',
                            'subtotal': '{{ $detail->harga * $detail->quantity }}',
                        }, @endforeach
                        ],
                    }">
                @endif
                <div
                    class="mt-5 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto custom-scrollbar">
                        <table class="w-full min-w-[1102px]">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 text-left sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Nama F&B
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 text-left sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Harga
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 text-left sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Quantity
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 text-left sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Subtotal
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transaction->details->isEmpty())
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <td colspan="4" class="px-5 py-4 sm:px-6">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400 text-center">Tidak
                                                Pesan Makan</p>
                                        </td>
                                    </tr>
                                @else
                                    <template x-for="detail in details" :key="detail.id">
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"
                                                    x-text="detail.nama_fnb"></p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"
                                                    x-text="detail.harga">
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"
                                                    x-text="detail.quantity"></p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"
                                                    x-text="detail.subtotal"></p>
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
    </div>
    <div x-data="{
        open: false,
        transactionId: null
    }"
        x-on:open-delete-modal.window="
        open = true;
        transactionId = $event.detail.id;
    " x-show="open"
        x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <!-- Modal box -->
        <div @click.outside="open = false" class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Hapus Transaksi
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Apakah anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button @click="open = false"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                    Cancel
                </button>

                <form :action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
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
