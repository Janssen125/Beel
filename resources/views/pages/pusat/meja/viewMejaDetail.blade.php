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
            status: '{{ $transaction->status }}',
            open: false,

            statuses: ['pending', 'completed', 'cancelled'],
            getStatusClass(status) {
                const classes = {
                    'completed': 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                    'pending': 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                    'cancelled': 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                }
                return classes[status] || '';
            },
            async updateStatus(newStatus) {
                this.status = newStatus;
                this.open = false;

                const response = await fetch('{{ route('transactions.updateStatus', $transaction->id) }}', {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: new URLSearchParams({
                        status: newStatus
                    })
                });

                if (!response.ok) {
                    console.error('Failed to update status');
                    return;
                }

                window.location.reload();

            }
        }">

            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-7 2xl:gap-x-32" x-data="timer('{{ $transaction->created_at }}', {{ $meja->harga_per_jam }})"
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
                                    <!-- Current status -->
                                    <div class="flex flex-row hover:cursor-pointer" @click="open = !open">
                                        <button class="px-3 py-1 text-xs font-semibold rounded-full"
                                            :class="getStatusClass(status)" x-text="status">
                                        </button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 48 48" class="text-gray-500 dark:text-gray-400">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" d="M36 18L24 30L12 18" />
                                        </svg>
                                    </div>

                                    <!-- Dropdown -->
                                    <div x-show="open" @click.outside="open = false"
                                        class="absolute z-10 mt-2 w-32 rounded-lg border bg-white shadow dark:border-gray-700 dark:bg-gray-800">
                                        <template x-for="s in statuses" :key="s">
                                            <button @click="updateStatus(s)"
                                                class="block w-full px-4 py-2 text-gray-700 dark:text-gray-100 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                x-text="s">
                                            </button>
                                        </template>
                                    </div>
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
                                    {{-- <span x-data="timer('{{ $transaction->created_at }}')" x-init="start()" x-text="display"
                                        class="font-mono"></span> --}}
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
                @if ($transaction->details->isNotEmpty())
                    <div x-data="{
                        details: [
                            @foreach ($transaction->details as $detail)
                        {
                            'id': '{{ $detail->id }}',
                            'nama_fnb': '{{ $detail->nama_fnb }}',
                            'harga': '{{ $detail->harga }}',
                            'quantity': '{{ $detail->quantity }}',
                            'subtotal': '{{ $detail->harga * $detail->quantity }}',
                        }, @endforeach
                        ],
                    }">
                @endif
                <a href="{{ route('mejas.addOrder', [$meja->id, $transaction->id]) }}">
                    <button class="create-button mt-5">
                        Add Order
                    </button>
                </a>
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
                                            <td class="px-5 py-4 sm:px-6">
                                                {{-- <a :href="`{{ url('mejas/{{ $meja->id }}/transactions/' . $transaction->id . '/details/') }}/${detail.id}/edit`"
                                                    class="text-blue-600 hover:underline dark:text-blue-400 text-theme-sm">
                                                    Edit
                                                </a> --}}
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                {{-- <form
                                                    :action="`{{ url('mejas/{{ $meja->id }}/transactions/' . $transaction->id . '/details/') }}/${detail.id}`"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:underline dark:text-red-400 text-theme-sm">
                                                        Delete
                                                    </button>
                                                </form> --}}
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
    <script>
        function timer(startTime, hargaPerJam) {
            return {
                startTimestamp: null,
                elapsedSeconds: 0,
                hargaPerJam: hargaPerJam,
                display: '00 Jam :00 Menit :00 Detik',
                interval: null,

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
                    return this.hargaPerJam * Math.floor(this.elapsedSeconds / 3600);
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
