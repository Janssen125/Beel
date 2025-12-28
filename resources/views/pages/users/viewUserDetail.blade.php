@extends('layouts.app')
@section('title', 'Detail Pengguna')
@section('content')
    <x-common.page-breadcrumb pageTitle="Detail Pengguna" />
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">Detail Pengguna, {{ $user->name }}
        </h3>
        <div x-data="{
            saveProfile() {
                console.log('Saving profile...');
            },
        }">
            <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Foto
                                Pengguna</p>
                            <div class="mb-5">
                                @if ($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo"
                                        class="h-24 w-24 rounded-full object-cover">
                                @else
                                    <div
                                        class="flex h-24 w-24 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-800">
                                        <span class="text-gray-500 dark:text-gray-400">No Image</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-7 2xl:gap-x-32">
                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->name ?? '-' }} (id = {{ $user->id ?? '-' }})</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->email ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Role</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->role ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Tanggal Lahir</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->dob ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->gender ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nomor HP</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->phone ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Alamat</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->address ?? '-' }}, {{ $user->kota->nama_kota ?? '-' }},
                                    {{ $user->provinsi->nama_provinsi ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">NIK</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $user->nik ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if (!(Auth::user()->id == $user->id))
                        <div class="flex gap-2 flex-row">
                            <button class="edit-button" @click="$dispatch('open-edit-modal', {{ $user->id }})"">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                        fill="" />
                                </svg>
                                Edit
                            </button>
                            @if (!($user->role == 'superadmin' || Auth::user()->role == $user->role))
                                @php
                                    $currentUserRole = 0;
                                    $dataUserRole = 0;

                                    switch (Auth::user()->role) {
                                        case 'superadmin':
                                            $currentUserRole = 3;
                                            break;
                                        case 'admin':
                                            $currentUserRole = 2;
                                            break;
                                        case 'user':
                                            $currentUserRole = 1;
                                            break;
                                        default:
                                            $currentUserRole = 0;
                                            break;
                                    }

                                    switch ($user->role) {
                                        case 'superadmin':
                                            $dataUserRole = 3;
                                            break;
                                        case 'admin':
                                            $dataUserRole = 2;
                                            break;
                                        case 'staff':
                                            $dataUserRole = 1;
                                            break;
                                        default:
                                            $dataUserRole = 0;
                                            break;
                                    }
                                @endphp
                                @if ($currentUserRole > $dataUserRole)
                                    <button class="delete-button"
                                        @click="$dispatch('open-delete-modal', {{ $user->id }})"">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 26 26">
                                            <path fill="currentColor"
                                                d="M11.5-.031c-1.958 0-3.531 1.627-3.531 3.594V4H4c-.551 0-1 .449-1 1v1H2v2h2v15c0 1.645 1.355 3 3 3h12c1.645 0 3-1.355 3-3V8h2V6h-1V5c0-.551-.449-1-1-1h-3.969v-.438c0-1.966-1.573-3.593-3.531-3.593zm0 2.062h3c.804 0 1.469.656 1.469 1.531V4H10.03v-.438c0-.875.665-1.53 1.469-1.53zM6 8h5.125c.124.013.247.031.375.031h3c.128 0 .25-.018.375-.031H20v15c0 .563-.437 1-1 1H7c-.563 0-1-.437-1-1zm2 2v12h2V10zm4 0v12h2V10zm4 0v12h2V10z" />
                                        </svg>
                                        Hapus
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div x-data="{
        open: false,
        userId: null
    }"
        x-on:open-delete-modal.window="
        open = true;
        userId = $event.detail.id;
    " x-show="open"
        x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <!-- Modal box -->
        <div @click.outside="open = false" class="w-full max-w-md rounded-xl bg-white p-6 dark:bg-gray-900">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Hapus Pengguna
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Apakah anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button @click="open = false"
                    class="rounded-lg border px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                    Cancel
                </button>

                <form :action="{{ route('users.destroy', $user->id) }}" method="POST">
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
