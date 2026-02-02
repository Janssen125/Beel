@extends('layouts.app')
@section('title', 'Detail Meja')
@section('content')
    @if (auth()->user()->role == 'staff')
        <x-common.page-breadcrumb pageTitle="Detail Meja" :breadcrumbs="[['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $transaction->pusat_id)]]" />
    @elseif(auth()->user()->role == 'admin')
        <x-common.page-breadcrumb pageTitle="Detail Meja" :breadcrumbs="[
            ['label' => 'Pusat Saya', 'url' => route('pusats.show', $transaction->pusat_id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $transaction->pusat_id)],
        ]" />
    @elseif(auth()->user()->role == 'superadmin')
        <x-common.page-breadcrumb pageTitle="Detail Meja" :breadcrumbs="[
            ['label' => 'Daftar Pusat', 'url' => route('pusats.index')],
            ['label' => 'Detail Pusat', 'url' => route('pusats.show', $transaction->pusat_id)],
            ['label' => 'Daftar Meja', 'url' => route('mejas.viewAll', $transaction->pusat_id)],
        ]" />
    @endif
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 lg:p-6">
        <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">Detail Meja,
            {{ $transaction->nomor_meja }}</h3>
        <div x-data="{
        
            showEditModal: false,
        
            form: {
                id: null,
                transaction_header_id: '',
                quantity: ''
            },
        
            openEditModal(detail) {
                this.form.id = detail.id;
                this.form.transaction_header_id = detail.transaction_header_id;
                this.form.quantity = detail.quantity;
        
                this.showEditModal = true;
            },
        
            closeModal() {
                this.showEditModal = false;
            },
        }">
            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-7 2xl:gap-x-32" x-data="timer('{{ $transaction->created_at }}', {{ $meja->harga_per_jam }}, @js($transaction->details))"
                            x-init="start()">
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama Staff</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->staff->name ?? '-' }}</p>
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
                                    {{ $transaction->pusat->nama_pusat ?? '-' }} </p>
                                </p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Status</p>
                                <div class="relative inline-block">
                                    @if ($transaction->status == 'pending')
                                        <span
                                            class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            Pending
                                        </span>
                                    @elseif ($transaction->status == 'completed')
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Completed
                                        </span>
                                    @elseif ($transaction->status == 'cancelled')
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Cancelled
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nomor Meja</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $transaction->nomor_meja ?? '-' }}</p>
                            </div>

                            <div>
                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Total Waktu</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="display">
                                </div>

                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Harga Per Jam</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $meja->harga_per_jam ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Total Harga</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    Rp <span x-text="formattedHarga"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-between">
                    <a href="{{ route('mejas.addOrder', [$meja->id, $transaction->id]) }}">
                        <button class="create-button mt-5">
                            Add Order
                        </button>
                    </a>
                    <div class="flex justify-between gap-5">
                        <?php
                        $total_harga = $meja->harga_per_jam * floor($transaction->created_at->diffInSeconds(now()) / 3600);
                        foreach ($transaction->details as $detail) {
                            $total_harga += $detail->harga * $detail->quantity;
                        }
                        ?>
                        <form action="{{ route('transactions.closeTable', [$meja->id, $transaction->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="nomor_meja" value="{{ $transaction->nomor_meja }}">
                            <input type="hidden" name="harga_per_jam" value="{{ $meja->harga_per_jam }}">
                            <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                            <input type="hidden" name="total_waktu_detik"
                                value="{{ floor($transaction->created_at->diffInSeconds(now())) }}">
                            <input type="hidden" name="status" value="completed">
                            <input type="hidden" name="waktu_tutup" value="{{ now() }}">
                            <x-ui.button type="submit" class="primary-button"
                                onclick="return confirm('Are you sure you want to close the table?');">
                                Close Table
                            </x-ui.button>
                        </form>
                        <form action="{{ route('transactions.closeTable', [$meja->id, $transaction->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="nomor_meja" value="{{ $transaction->nomor_meja }}">
                            <input type="hidden" name="harga_per_jam" value="{{ $meja->harga_per_jam }}">
                            <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                            <input type="hidden" name="total_waktu_detik"
                                value="{{ floor($transaction->created_at->diffInSeconds(now())) }}">
                            <input type="hidden" name="status" value="cancelled">
                            <input type="hidden" name="waktu_tutup" value="{{ now() }}">
                            <x-ui.button type="submit" class="delete-button"
                                onclick="return confirm('Are you sure you want to close the table?');">
                                Cancel Table
                            </x-ui.button>
                        </form>
                    </div>
                </div>

                <div
                    class="mt-5 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
                    <div class="max-w-full overflow-x-auto custom-scrollbar">
                        <table class="w-full">
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
                                    <th class="px-5 py-3 text-left sm:px-6" colspan=2>
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Aksi
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody x-data="{
                                details: [
                                    @foreach ($transaction->details as $detail)
                                    {
                                        'id': '{{ $detail->id }}',
                                        'transaction_header_id': '{{ $detail->transaction_header_id }}',
                                        'nama_fnb': '{{ $detail->nama_fnb }}',
                                        'harga': {{ $detail->harga }},
                                        'quantity': {{ $detail->quantity }},
                                        'subtotal': {{ $detail->harga * $detail->quantity }},
                                     }@if (!$loop->last),@endif @endforeach
                                ],
                            }">
                                @if ($transaction->details->isEmpty())
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <td colspan="4" class="px-5 py-4 sm:px-6">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400 text-center">Tidak
                                                Pesan Makan</p>
                                        </td>
                                    </tr>
                                @elseif ($transaction->details->isNotEmpty())
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
                                            <td class="px-5 py-4 sm:px-6">
                                                <x-ui.button class="edit-button" variant="outline"
                                                    @click="openEditModal(detail)">
                                                    Ubah
                                                </x-ui.button>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <form :action="`/pusat/mejas/{{ $meja->id }}/deleteOrder/${detail.id}`"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-button">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </template>
                                @endif
                            </tbody>
                        </table>

                        <!-- EDIT MODAL -->
                        <div x-show="showEditModal" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-white/30 dark:text-gray-400"
                            @keydown.escape.window="closeModal()">
                            <div @click.outside="closeModal()"
                                class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">

                                <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">
                                    Ubah Order
                                </h3>

                                <form
                                    :action="`/pusat/mejas/{{ $meja->id }}/updateOrder/${form.transaction_header_id}`"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" :value="form.id">
                                    <input type="hidden" name="transaction_header_id"
                                        :value="form.transaction_header_id">
                                    <div class="mb-4">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Quantity
                                        </label>
                                        <input type="number" name="quantity" x-model="form.quantity" min="1"
                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm dark:text-white/90 dark:bg-gray-900 text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden  dark:placeholder:text-white/30
                                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300  dark:border-gray-700
                                                                   " />
                                        <div class="flex justify-end gap-2 mt-4">
                                            <button type="button" @click="closeModal()"
                                                class="px-4 py-2 rounded-lg border">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white">
                                                Ubah
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function timer(startTime, hargaPerJam, details = []) {
            return {
                startTimestamp: null,
                elapsedSeconds: 0,
                hargaPerJam: hargaPerJam,
                display: '00 Jam :00 Menit :00 Detik',
                interval: null,
                details: details,

                start() {
                    this.startTimestamp = new Date(startTime).getTime();
                    this.update();
                    this.interval = setInterval(() => this.update(), 1000);
                },

                update() {
                    this.elapsedSeconds = Math.floor(
                        (Date.now() - this.startTimestamp) / 1000
                    );

                    const h = Math.floor(this.elapsedSeconds / 3600);
                    const m = Math.floor((this.elapsedSeconds % 3600) / 60);
                    const s = this.elapsedSeconds % 60;

                    this.display =
                        String(h).padStart(2, '0') + ' Jam : ' +
                        String(m).padStart(2, '0') + ' Menit : ' +
                        String(s).padStart(2, '0') + ' Detik';
                },

                get totalHarga() {
                    let fnbTotal = this.details.reduce((sum, item) => {
                        return sum + (item.harga * item.quantity);
                    }, 0);
                    let mejaTotal = this.hargaPerJam * Math.floor(this.elapsedSeconds / 3600);
                    return fnbTotal + mejaTotal;
                },

                get formattedHarga() {
                    return this.totalHarga.toLocaleString('id-ID', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    });
                }
            }
        }
    </script>


@endsection
