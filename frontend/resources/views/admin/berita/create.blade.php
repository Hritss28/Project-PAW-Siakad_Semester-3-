<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Tambah Berita</h2>
                <form id="beritaForm" class="space-y-4">
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                            Judul Berita
                        </label>
                        <input type="text" name="judul" id="judul"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan judul berita">
                    </div>

                    <div class="mb-4">
                        <label for="konten" class="block text-gray-700 text-sm font-bold mb-2">
                            Konten Berita
                        </label>
                        <textarea name="konten" id="konten" rows="6"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan konten berita"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">
                            Pilih Gambar
                        </label>
                        <input type="file" name="gambar" id="gambar"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan link gambar">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Tambah Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-admin-sidebar>
</x-admin-layout>

<script>
    const beritaForm = document.getElementById('beritaForm');
    beritaForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(beritaForm);
        try {
            const token = await axios.post('/token/get-token').then(res => res.data);
            const response = await axios.post('http://localhost:3000/api/berita/create', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-API-TOKEN': `${token}`
                }
            });
            if (response.status === 201) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Berita berhasil ditambahkan",
                });
                window.location.replace('/admin/service/berita');
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response?.data.errors || error.message,
            });
        }
    });
</script>
