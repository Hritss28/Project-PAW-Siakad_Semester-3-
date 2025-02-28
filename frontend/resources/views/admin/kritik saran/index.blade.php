<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="p-4">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Kritik dan Saran</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">No</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Pesan</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-admin-sidebar>
</x-admin-layout>
