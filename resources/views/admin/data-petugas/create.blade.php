<x-app-layout>
    <x-slot name="header">
        Tambah Petugas
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl rounded-2xl p-8">

                <form action="{{ route('admin.data-petugas.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-medium mb-1 text-[#09637E]">Nama</label>
                        <input type="text" name="nama"
                               class="w-full border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none"
                               required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium mb-1 text-[#09637E]">Username</label>
                        <input type="text" name="username"
                               class="w-full border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395]"
                               required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium mb-1 text-[#09637E]">Email</label>
                        <input type="email" name="email"
                               class="w-full border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395]"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1 text-[#09637E]">Password</label>
                        <input type="password" name="password"
                               class="w-full border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395]"
                               required>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.data-petugas.index') }}"
                           class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">
                            Kembali
                        </a>

                        <button class="bg-[#09637E] hover:bg-[#088395] text-white px-6 py-2 rounded-lg shadow transition">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
