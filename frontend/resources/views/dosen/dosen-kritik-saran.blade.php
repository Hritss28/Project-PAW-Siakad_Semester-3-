<x-dosen-layout :teacher="$teacher">
    <x-layout>
        <main class="ml-20 mr-20 mt-5">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="border-b border-gray-200 mb-6">
                    <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">
                        Form Kritik dan Saran NextSiakad
                    </h1>
                    <p class="text-gray-600 mb-4 text-center">
                        Silakan isi form berikut untuk memberikan kritik dan saran Anda pada layanan siakad kami.
                    </p>
                </div>

                <form id="kritik-saran">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                        <textarea name="pesan" id="pesan" rows="4" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </x-layout>
</x-dosen-layout>
<script>
    const form = document.querySelector('#kritik-saran');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = e.target.name.value;
        const email = e.target.email.value;
        const pesan = e.target.pesan.value;
        try {
            const token = await axios.post('/token/get-token').then(res => res.data);
            const response = await axios.post('http://localhost:3000/api/kritikSaran/create', {
                name,
                email,
                pesan
            }, {
                headers: {
                    'X-API-TOKEN': `${token}`
                }
            }).then(data => data.data);
            if (response.status === 201) {
                Swal.fire({
                    icon: "success",
                    title: "Success Add Kritik Saran",
                    text: response.message,
                })
                window.location.replace('http://127.0.0.1:8000/dosen/dashboard');
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response.data.errors || error.message,
            })
        }
    })
</script>