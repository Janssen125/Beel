@extends('layouts.app')
@section('title', 'Update Pusat FnB')
@section('content')
    <x-common.page-breadcrumb pageTitle="Update Pusat FnB" :breadcrumbs="[
        ['label' => 'Daftar Pusat', 'url' => route('pusats.index')],
        ['label' => 'Detail Pusat', 'url' => route('pusats.show', $pusat->id)],
    ]" />
    <div
        class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
        <div class="mx-auto w-full text-center">
            <h3 class="mb-4 font-semibold text-gray-800 text-theme-xl dark:text-white/90 sm:text-2xl">
                Ubah Makanan / Minuman
            </h3>
            <form method="POST" action="{{ route('pusats.fnbs.sync', $pusat->id) }}" x-data="{
                fnbs: @js($fnbs),
                selected: @js($selectedFnbs),
            
                createItem() {
                    return { harga: 0 }
                }
            }"
                class="space-y-6 w-full">

                @csrf
                @method('PUT')

                <div class="flex sm:flex-row gap-3 flex-col text-gray-800 w-full dark:text-white/90">
                    <div class="rounded-xl border p-4 w-6/12">
                        <h4 class="mb-3 font-semibold">Daftar FnB</h4>

                        <div class="space-y-2 max-h-[420px] overflow-y-auto">
                            <template x-for="fnb in fnbs" :key="fnb.id">
                                <label
                                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:text-gray-800 cursor-pointer">
                                    <input type="checkbox" :checked="selected.hasOwnProperty(fnb.id)"
                                        @change="
                                        if ($event.target.checked) {
                                            selected[fnb.id] = createItem()
                                        } else {
                                            delete selected[fnb.id]
                                        }
                                        "
                                        class="rounded border-gray-300">

                                    <span class="text-sm" x-text="fnb.nama_fnb"></span>

                                </label>
                            </template>
                        </div>
                    </div>

                    <div class="rounded-xl border p-4 w-6/12">
                        <h4 class="mb-3 font-semibold">FnB Terpilih</h4>

                        <template x-if="Object.keys(selected).length === 0">
                            <p class="text-sm text-gray-400">Belum ada FnB dipilih</p>
                        </template>

                        <div class="space-y-3 max-h-[420px] overflow-y-auto">
                            <template x-for="[fnbId, data] in Object.entries(selected)" :key="fnbId">
                                <template x-if="data">
                                    <div class="flex items-center justify-between gap-3 border rounded-lg p-3">
                                        <span class="text-sm font-medium"
                                            x-text="fnbs.find(f => f.id == fnbId)?.nama_fnb"></span>

                                        <input type="number" min="0"
                                            class="w-32 rounded-lg border px-2 py-1 text-sm" x-model.number="data.harga"
                                            :name="`fnbs[${fnbId}][harga]`">
                                    </div>
                                </template>
                            </template>

                        </div>
                    </div>

                </div>

                <div class="flex justify-end">
                    <x-ui.button type="submit">
                        Simpan Perubahan
                    </x-ui.button>
                </div>

            </form>

        </div>
    </div>
@endsection
