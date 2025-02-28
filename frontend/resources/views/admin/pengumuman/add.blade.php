<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <main class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-4">Tambah Pengumuman Baru</h1>

                <form id="pengumumanForm" class="space-y-4">
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                            Judul Pengumuman
                        </label>
                        <input type="text" name="judulPengumuman" id="judulPengumuman"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan judul pengumuman">
                    </div>

                    <div class="mb-4">
                        <label for="konten" class="block text-gray-700 text-sm font-bold mb-2">
                            Konten Pengumuman
                        </label>
                        <textarea name="kontenPengumuman" id="kontenPengumuman" rows="6"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan konten pengumuman"></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <button type="button" onclick="window.history.back()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            Simpan Pengumuman
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <script>
            const pengumumanForm = document.getElementById('pengumumanForm');
            pengumumanForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const judul = e.target.judulPengumuman.value;
                const konten = e.target.kontenPengumuman.value;
                const token = await axios.post('/token/get-token').then(res => res.data);
                try {
                    const response = await axios.post('http://localhost:3000/api/announcements/create', {
                        judul,
                        konten,
                    }, {
                        headers: {
                            'X-API-TOKEN': `${token}`
                        }
                    });
                    if (response.status === 201) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.data.message,
                        })
                        window.location.replace('/admin/service/pengumuman');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: error.response?.data.errors || error.message,
                    })
                }
            });
        </script>
    </x-admin-sidebar>
</x-admin-layout>
