{{-- {{ dd($feedbacks) }} --}}

<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6">Kritik dan Saran</h1>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Pesan</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks['data'] as $feedback)
                            <tr class="border-b">
                                <input type="hidden" name="id" id="id" value="{{ $feedback['id'] }}">
                                <td class="px-4 py-2">{{ $feedback['name'] }}</td>
                                <td class="px-4 py-2">{{ $feedback['email'] }}</td>
                                <td class="px-4 py-2">
                                    <div class="max-w-xs overflow-hidden overflow-ellipsis">
                                        {{ $feedback['pesan'] }}
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline delete">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center">Tidak ada data kritik dan saran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-admin-sidebar>
</x-admin-layout>

<script>
    const deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.parentElement.parentElement.querySelector('input[name="id"]').value;
            const token = await axios.post('/token/get-token').then(res => res.data);
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus kritik dan saran ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await axios.delete(
                            `http://localhost:3000/api/kritikSaran/${id}`, {
                                headers: {
                                    'X-API-TOKEN': `${token}`
                                }
                            });
                        if (response.status === 201) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Kritik dan saran berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: error.response?.data.errors || error.message,
                        })
                    }
                }
            })
        })
    })
</script>
