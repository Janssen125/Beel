@extends('layouts.app')
@section('title', 'Daftar Makanan & Minuman')
@section('content')
    <x-common.page-breadcrumb pageTitle="Daftar Makanan & Minuman" />
    <div x-data="{
        fnbs: [
            @foreach ($fnbs as $fnb)
        {
            'id': {{ $fnb->id }},
            'nama_fnb': '{{ $fnb->nama_fnb ?? '-' }}',
            'harga': '{{ $fnb->harga ?? '-' }}',
            'deskripsi': '{{ $fnb->deskripsi ?? '-' }}',
            'foto_fnb': '{{ $fnb->foto_fnb ?? '../images/user/user-02.jpg' }}'
        }@if (!$loop->last),@endif @endforeach
        ],
    
    
        search: '',
    
        itemsPerPage: 10,
        currentPage: 1,
        dropdownOpen: null,
    
        get filteredFnbs() {
            if (!this.search) return this.fnbs;
    
            const q = this.search.toLowerCase();
    
            return this.fnbs.filter(fnb =>
                fnb.nama_fnb.toLowerCase().includes(q) ||
                fnb.harga.toLowerCase().includes(q) ||
                fnb.deskripsi.toLowerCase().includes(q)
            );
        },
    
        get totalPages() {
            return Math.ceil(this.filteredFnbs.length / this.itemsPerPage);
        },
    
        get paginatedFnbs() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredFnbs.slice(start, start + this.itemsPerPage);
        },
    
        get displayedPages() {
            const range = [];
            for (let i = 1; i <= this.totalPages; i++) {
                if (
                    i === 1 ||
                    i === this.totalPages ||
                    (i >= this.currentPage - 1 && i <= this.currentPage + 1)
                ) {
                    range.push(i);
                } else if (range[range.length - 1] !== '...') {
                    range.push('...');
                }
            }
            return range;
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToPage(page) {
            if (typeof page === 'number' && page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },
        toggleDropdown(id) {
            this.dropdownOpen = this.dropdownOpen === id ? null : id;
        }
    }">
        <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Header -->
            <div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Daftar Makanan & Minuman</h3>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <form>
                        <div class="relative">
                            <button type="button" class="absolute -translate-y-1/2 left-4 top-1/2">
                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                        fill="" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Search..." x-model.debounce.300ms="search"
                                @input="currentPage = 1"
                                class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-100" />
                        </div>
                    </form>
                    @can('create', $fnbs)
                        <a href="{{ route('fnbs.create') }}">
                            <button class="create-button">
                                Tambah Makanan & Minuman
                            </button>
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden">
                <div class="max-w-full px-5 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-gray-200 border-y dark:border-gray-700">
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    ID</th>
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    Nama Makanan / Minuman</th>
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    Harga</th>
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    Deskripsi</th>
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    Foto Makanan / Minuman</th>
                                <th scope="col"
                                    class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="fnb in paginatedFnbs" :key="fnb.id">
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="text-sm text-gray-500 dark:text-gray-400" x-text="fnb.id">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400" x-text="fnb.nama_fnb">
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400" x-text="fnb.harga">
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400" x-text="fnb.deskripsi">
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="w-10 h-10 overflow-hidden rounded-full">
                                                <img :src="fnb.foto_fnb" :alt="fnb.name">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        @can('update', \App\Models\Fnb::class)
                                            <div class="flex justify-center relative">
                                                <a :href="`/fnbs/${fnb.id}/edit`">
                                                    <x-ui.button variant="outline">
                                                        Edit
                                                    </x-ui.button>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('delete', \App\Models\Fnb::class)
                                            <button class="delete-button"
                                                @click="$dispatch('open-delete-modal', { id: fnb.id })">
                                                Hapus
                                            </button>
                                        @endcan

                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
                <div class="flex items-center justify-between">
                    <button @click="prevPage" :disabled="currentPage === 1"
                        :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:px-3.5">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.58301 9.99868C2.58272 10.1909 2.65588 10.3833 2.80249 10.53L7.79915 15.5301C8.09194 15.8231 8.56682 15.8233 8.85981 15.5305C9.15281 15.2377 9.15297 14.7629 8.86018 14.4699L5.14009 10.7472L16.6675 10.7472C17.0817 10.7472 17.4175 10.4114 17.4175 9.99715C17.4175 9.58294 17.0817 9.24715 16.6675 9.24715L5.14554 9.24715L8.86017 5.53016C9.15297 5.23717 9.15282 4.7623 8.85983 4.4695C8.56684 4.1767 8.09197 4.17685 7.79917 4.46984L2.84167 9.43049C2.68321 9.568 2.58301 9.77087 2.58301 9.99715C2.58301 9.99766 2.58301 9.99817 2.58301 9.99868Z"
                                fill="currentColor" />
                        </svg>
                        <span class="hidden sm:inline">Previous</span>
                    </button>

                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-400 sm:hidden">
                        Page <span x-text="currentPage"></span> of <span x-text="totalPages"></span>
                    </span>

                    <ul class="hidden items-center gap-0.5 sm:flex">
                        <template x-for="page in displayedPages" :key="page">
                            <li>
                                <button x-show="page !== '...'" @click="goToPage(page)"
                                    :class="currentPage === page ? 'bg-blue-500 text-white' :
                                        'text-gray-700 hover:bg-blue-500/[0.08] hover:text-blue-500 dark:text-gray-400 dark:hover:text-blue-500'"
                                    class="flex h-10 w-10 items-center justify-center rounded-lg text-theme-sm font-medium"
                                    x-text="page"></button>
                                <span x-show="page === '...'"
                                    class="flex h-10 w-10 items-center justify-center text-gray-500">...</span>
                            </li>
                        </template>
                    </ul>

                    <button @click="nextPage" :disabled="currentPage === totalPages"
                        :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:px-3.5">
                        <span class="hidden sm:inline">Next</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.4175 9.9986C17.4178 10.1909 17.3446 10.3832 17.198 10.53L12.2013 15.5301C11.9085 15.8231 11.4337 15.8233 11.1407 15.5305C10.8477 15.2377 10.8475 14.7629 11.1403 14.4699L14.8604 10.7472L3.33301 10.7472C2.91879 10.7472 2.58301 10.4114 2.58301 9.99715C2.58301 9.58294 2.91879 9.24715 3.33301 9.24715L14.8549 9.24715L11.1403 5.53016C10.8475 5.23717 10.8477 4.7623 11.1407 4.4695C11.4336 4.1767 11.9085 4.17685 12.2013 4.46984L17.1588 9.43049C17.3173 9.568 17.4175 9.77087 17.4175 9.99715C17.4175 9.99763 17.4175 9.99812 17.4175 9.9986Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{
        open: false,
        fnbId: null
    }"
        x-on:open-delete-modal.window="
        open = true;
        fnbId = $event.detail.id;
    " x-show="open"
        x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-white/30">
        <!-- Modal box -->
        <div @click.outside="open = false" class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Hapus Makanan / Minuman
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Apakah anda yakin ingin menghapus makanan / minuman ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button @click="open = false"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                    Cancel
                </button>

                <form :action="`/fnbs/${fnbId}`" method="POST">
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
