<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8">
            <div class="p-4 border-2 bg-white border-gray-200 rounded-lg">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold">Manajemen Akun Teacher</h2>
                    <p class="text-sm text-gray-500">Kelola administrator Anda dengan mudah dari sini</p>
                </div>

                <form id="teacherForm" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <input type="text" name="name"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">NIP</label>
                            <input type="text" name="nip"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="date"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                            <select name="gender"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition duration-200">
                                <option value="MAN">Male</option>
                                <option value="WOMAN">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                        <a href="/admin/users"
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-ultramarine-400 to-ultramarine-500 text-white hover:from-ultramarine-500 hover:to-ultramarine-600 transition-all duration-200 shadow-md hover:shadow-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            const teacherForm = document.querySelector('#teacherForm');
            teacherForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const name = e.target.name.value;
                const email = e.target.email.value;
                const nip = e.target.nip.value;
                const password = e.target.password.value;
                const tanggalLahir = e.target.date.value;
                const gender = e.target.gender.value;
                try {
                    const token = await axios.post('/token/get-token').then(res => res.data);
                    const response = await axios.post('http://localhost:3000/api/teacher/register', {
                        name,
                        email,
                        nip,
                        password,
                        tanggalLahir,
                        gender
                    }, {
                        headers: {
                            'X-API-TOKEN': token
                        }
                    }).then(data => data.data);
                    if (response.status === 201) {
                        swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message,
                        })
                        window.location.replace('/admin/users')
                    }
                } catch (error) {
                    swal.fire({
                        icon: "error",
                        title: "Error",
                        text: error.response.data.errors || error.message,
                    })
                }
            })
        </script>
    </x-admin-sidebar>
</x-admin-layout>
