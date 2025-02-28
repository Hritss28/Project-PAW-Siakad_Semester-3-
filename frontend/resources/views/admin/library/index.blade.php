{{-- {{ dd($libraries) }} --}}
<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <h2 class="text-2xl font-bold text-gray-800">Library Management</h2>
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari Buku..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <a href="/admin/service/perpustakaan/create"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                Tambah Buku
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Cover</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Title</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Author</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Pages</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Description</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($libraries == null):
                                <tr>
                                    <td colspan="6" class="text-center py-4">Data not found</td>
                                </tr>
                            @else
                                @foreach ($libraries['data'] as $library)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <img src="http://localhost:3000/uploads/perpustakaan/{{ $library['cover'] }}"
                                                alt="{{ $library['title'] }}" class="w-16 h-24 object-cover rounded">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">{{ $library['title'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">{{ $library['author'] }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $library['page'] }}</td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600 truncate w-64">{{ $library['description'] }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3">
                                                <button type="button"
                                                    onclick="openEditLibraryModal('{{ $library['id'] }}', '{{ $library['title'] }}', '{{ $library['author'] }}', '{{ $library['page'] }}', '{{ $library['description'] }}', '{{ $library['cover'] }}')"
                                                    class="px-3 py-1 bg-ultramarine-400 text-white rounded-md hover:bg-ultramarine-900 transition-colors">
                                                    Edit
                                                </button>
                                                <button type="button"
                                                    onclick="deleteConfirmation({{ $library['id'] }})"
                                                    class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-900 transition-colors">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-admin-sidebar>
</x-admin-layout>

<x-library-edit />

<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const token = await axios.post('/token/get-token').then(res => res.data);
                    const response = await axios.delete(`http://localhost:3000/api/library/${id}`, {
                        headers: {
                            'X-API-TOKEN': `${token}`
                        }
                    }).then(data => data.data);
                    if (response.status === 201) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message,
                        })
                        location.reload();
                    }
                } catch (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: error.response?.data.errors || error.message,
                    })
                }
            }
        });
    }
</script>
