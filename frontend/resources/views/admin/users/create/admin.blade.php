<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-10">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Akun Admin</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola administrator Anda dengan mudah dari sini</p>
                </div>

                <form class="space-y-6" id="adminForm">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Nama</label>
                            <input type="text" id="adminName" name="name"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400 transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" id="adminEmail" name="email"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400 transition-all">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700">Password</label>
                            <input type="password" id="adminPwd" name="password"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400 transition-all">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                        <a href="/admin/users"
                            class="px-6 py-2.5 bg-red-500 text-white rounded-md hover:bg-red-900 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-ultramarine-400 text-white rounded-md hover:bg-ultramarine-900 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const adminForm = document.querySelector('#adminForm');
            adminForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const name = e.target.name.value;
                const email = e.target.email.value;
                const password = e.target.password.value;
                try {
                    const token = await axios.post('/token/get-token').then(res => res.data);
                    const response = await axios.post('http://localhost:3000/api/admin/register', {
                        name,
                        email,
                        password
                    }, {
                        headers: {
                            'X-API-TOKEN': token
                        }
                    }).then(data => data.data);
                    if (response.status === 201) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message,
                        })
                        window.location.replace('/admin/users')
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
    </x-admin-sidebar>
</x-admin-layout>
