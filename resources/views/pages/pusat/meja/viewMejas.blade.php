@extends('layouts.app')
@section('title', 'Daftar Meja')
@section('content')
    @if (auth()->user()->role == 'staff')
        <x-common.page-breadcrumb pageTitle="Daftar Meja" />
    @elseif(auth()->user()->role == 'admin')
        <x-common.page-breadcrumb pageTitle="Daftar Meja" :breadcrumbs="[['label' => 'Pusat Saya', 'url' => route('pusats.show', $pusat->id)]]" />
    @elseif(auth()->user()->role == 'superadmin')
        <x-common.page-breadcrumb pageTitle="Daftar Meja" :breadcrumbs="[
            ['label' => 'Daftar Pusat', 'url' => route('pusats.index')],
            ['label' => 'Detail Pusat', 'url' => route('pusats.show', $pusat->id)],
        ]" />
    @endif
    <div
        class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
        <div class="mx-auto w-full text-center">
            <div class="flex flex-col sm:flex-row justify-between mb-3">
                <h3 class="mb-4 font-semibold text-gray-800 text-theme-xl dark:text-white/90 sm:text-2xl">
                    Daftar Meja
                </h3>
                @can('create', \App\Models\Meja::class)
                    <a href="{{ route('mejas.createMeja', $pusat->id) }}">
                        <button class="create-button">
                            Tambah Meja
                        </button>
                    </a>
                @endcan
            </div>
            <div class="flex grow flex-wrap flex-4 gap-10 w-full justify-center py-4">
                @foreach ($mejas as $meja)
                    <x-meja-card :title="$meja->nomor_meja">
                        <x-slot:desc>
                            @if ($meja->activeTransaction)
                                <span x-data="timer('{{ $meja->activeTransaction->created_at }}')" x-init="start()" x-text="display"
                                    class="font-mono"></span>
                            @elseif ($meja->status == 'rusak')
                                <span class="text-red-500">Rusak</span>
                            @elseif ($meja->status == 'tidak_tersedia')
                                <span class="text-yellow-500">Tidak Tersedia</span>
                            @elseif ($meja->status == 'kosong')
                                <span class="text-gray-400">Kosong</span>
                            @else
                                <span class="">-</span>
                            @endif
                        </x-slot:desc>
                        <div class="space-y-4">
                            <div class="flex justify-center gap-5 flex-col sm:flex-row">
                                @if ($meja->activeTransaction)
                                    <a href="{{ route('mejas.show', $meja->id) }}"
                                        class="flex justify-center items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                                        Lihat Detail
                                    </a>
                                @else
                                    @if ($meja->status == 'kosong')
                                        <a href="{{ route('transactions.createOrder', $meja->id) }}"
                                            class="flex justify-center items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                                            Mulai Buka Meja
                                        </a>
                                    @endif
                                @endif
                                @can('update', $meja)
                                    <a href="{{ route('mejas.edit', $meja->id) }}"
                                        class="flex justify-center items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                                        Ubah Meja
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </x-meja-card>
                @endforeach

            </div>
        </div>
    </div>
    <script>
        function timer(startTime) {
            return {
                start: null,
                display: '00:00:00',
                interval: null,

                start() {
                    this.start = new Date(startTime).getTime();
                    this.update();
                    this.interval = setInterval(() => this.update(), 1000);
                },

                update() {
                    let diff = Math.floor((Date.now() - this.start) / 1000);

                    const h = Math.floor(diff / 3600);
                    diff %= 3600;
                    const m = Math.floor(diff / 60);
                    const s = diff % 60;

                    this.display =
                        String(h).padStart(2, '0') + ':' +
                        String(m).padStart(2, '0') + ':' +
                        String(s).padStart(2, '0');
                }
            }
        }
    </script>

@endsection
