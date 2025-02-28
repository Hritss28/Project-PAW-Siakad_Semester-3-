{{-- {{ dd($news) }} --}}
<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">Data Berita</h2>
                        <p class="mt-2 text-lg text-gray-600">Kelola semua berita yang tersedia</p>
                    </div>
                    <div>
                        <a href="/admin/service/berita/create"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Berita
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($news['data'] as $item)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="http://localhost:3000/uploads/berita/{{ $item['gambar'] }}"
                                alt="{{ $item['judul'] }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($item['createdAt'])->format('d F Y') }}
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                {{ $item['judul'] }}
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $item['konten'] }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t">
                                <div class="space-x-2">
                                    <button
                                        onclick="openEditModal('{{ $item['id'] }}', '{{ $item['judul'] }}', '{{ $item['konten'] }}', '{{ $item['gambar'] }}')"
                                        class="inline-flex items-center px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button onclick="deleteBerita({{ $item['id'] }})"
                                        class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            async function deleteBerita(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Berita akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const token = await axios.post('/token/get-token').then(res => res.data);
                            const response = await axios.delete(`http://localhost:3000/api/berita/${id}`, {
                                headers: {
                                    'X-API-TOKEN': token
                                }
                            });
                            if (response.status === 201) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Berita berhasil dihapus.',
                                    'success'
                                );
                                window.location.reload();
                            }
                        } catch (error) {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: error.response?.data.errors || error.message,
                            });
                        }
                    }
                });
            }
        </script>
    </x-admin-sidebar>
</x-admin-layout>
<x-berita-edit />
