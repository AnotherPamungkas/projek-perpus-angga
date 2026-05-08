<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3D3D3B] leading-tight">
            Tambah Petugas
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F4F2] py-8">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 shadow-sm">
                    <p class="font-semibold text-red-600 mb-2">
                        Terjadi kesalahan:
                    </p>

                    <ul class="text-sm text-red-500 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                    <h3 class="text-xl font-bold text-[#3D3D3B]">
                        Form Tambah Petugas
                    </h3>

                    <p class="text-sm text-[#3D3D3B]/60 mt-1">
                        Tambahkan data petugas baru ke dalam sistem.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('admin.data-petugas.store') }}"
                      method="POST"
                      class="p-8">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama Lengkap --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                   name="nama"
                                   value="{{ old('nama') }}"
                                   required
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                          focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none">
                        </div>

                        {{-- Username --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Username
                            </label>

                            <input type="text"
                                   name="username"
                                   value="{{ old('username') }}"
                                   required
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                          focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                          focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none">
                        </div>

                        {{-- Password --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   required
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                          focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none">

                            <p class="text-xs text-[#3D3D3B]/60 mt-2">
                                Gunakan password yang aman dan mudah diingat.
                            </p>
                        </div>

                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-[#BBBFCA]">

                        <a href="{{ route('admin.data-petugas.index') }}"
                           class="px-5 py-3 rounded-2xl border border-[#BBBFCA]
                                  text-[#3D3D3B] hover:bg-[#F4F4F2] transition">
                            Kembali
                        </a>

                        <button type="submit"
                                class="px-6 py-3 rounded-2xl bg-[#3D3D3B]
                                       text-white hover:opacity-90 transition">
                            Simpan Petugas
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
