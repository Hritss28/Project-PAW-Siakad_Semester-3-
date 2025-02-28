<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-8" x-data="userManagement()">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>

                        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                            <!-- Search Box -->
                            <div class="relative w-full sm:w-64">
                                <input type="text" x-model="searchTerm"
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-ultramarine-300 focus:border-ultramarine-400"
                                    placeholder="Cari pengguna...">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Role Filter -->
                            <select
                                class="w-full sm:w-auto p-2 border rounded-lg focus:ring-2 focus:ring-ultramarine-300 focus:border-ultramarine-400"
                                x-model="filterRole">
                                <option value="">Semua Role</option>
                                <option value="STUDENT">Mahasiswa</option>
                                <option value="TEACHER">Dosen</option>
                            </select>

                            <!-- Add User Button -->
                            <div x-data="{ open: false }" class="relative w-full sm:w-auto">
                                <button @click="open = !open"
                                    class="w-full sm:w-auto bg-ultramarine-500 text-white px-6 py-2.5 rounded-lg hover:bg-ultramarine-600 transition duration-200 flex items-center justify-center gap-2">
                                    <span>Tambah User</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                                    <a href="/admin/users/create/admin"
                                        class="block px-4 py-2 text-gray-700 hover:bg-ultramarine-50 hover:text-ultramarine-600">Admin</a>
                                    <a href="/admin/users/create/teacher"
                                        class="block px-4 py-2 text-gray-700 hover:bg-ultramarine-50 hover:text-ultramarine-600">Teacher</a>
                                    <a href="/admin/users/create/student"
                                        class="block px-4 py-2 text-gray-700 hover:bg-ultramarine-50 hover:text-ultramarine-600">Student</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Role</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(user, index) in paginatedAndFilteredUsers" :key="user.id">
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                                        x-text="index + 1 + (currentPage - 1) * rowsPerPage"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800"
                                        x-text="user.name"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600" x-text="user.email">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium"
                                            :class="{
                                                'bg-green-100 text-green-800': user.role === 'TEACHER',
                                                'bg-blue-100 text-blue-800': user.role === 'STUDENT',
                                                'bg-purple-100 text-purple-800': user.role === 'ADMIN'
                                            }"
                                            x-text="user.role">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-3">
                                            <button @click="$dispatch('update-modal', { user: user })"
                                                class="text-ultramarine-600 hover:text-ultramarine-800 transition-colors duration-200 flex items-center gap-1">
                                                <x-far-edit class="w-4 h-4" />
                                                <span class="hidden sm:inline">Ubah</span>
                                            </button>
                                            <button @click="deleteUser(user.id)"
                                                class="text-red-500 hover:text-red-700 transition-colors duration-200 flex items-center gap-1">
                                                <x-ionicon-trash-outline class="w-4 h-4" />
                                                <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Showing <span x-text="((currentPage - 1) * rowsPerPage) + 1"></span>
                            to <span x-text="Math.min(currentPage * rowsPerPage, filteredUsers.length)"></span>
                            of <span x-text="filteredUsers.length"></span> entries
                        </div>
                        <div class="flex items-center space-x-2">
                            <!-- Previous Button -->
                            <button @click="currentPage = Math.max(1, currentPage - 1)" :disabled="currentPage === 1"
                                :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                                class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <!-- Page Numbers -->
                            <div class="flex space-x-1">
                                <template x-for="page in totalPages" :key="page">
                                    <button @click="currentPage = page"
                                        :class="{
                                            'bg-ultramarine-500 text-white border-ultramarine-500': currentPage ===
                                                page,
                                            'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': currentPage !==
                                                page
                                        }"
                                        class="px-3 py-1 border rounded-lg text-sm font-medium min-w-[2.25rem] transition-colors duration-200"
                                        x-text="page">
                                    </button>
                                </template>
                            </div>

                            <!-- Next Button -->
                            <button @click="currentPage = Math.min(totalPages, currentPage + 1)"
                                :disabled="currentPage === totalPages"
                                :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                                class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function userManagement() {
                    return {
                        users: @json($users['data']),
                        currentPage: 1,
                        rowsPerPage: 10,
                        filterRole: '',
                        searchTerm: '',
                        get filteredUsers() {
                            return this.users.filter(user => {
                                const matchesRole = this.filterRole ? user.role === this.filterRole : true;
                                const matchesSearch = this.searchTerm ?
                                    user.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                                    user.email.toLowerCase().includes(this.searchTerm.toLowerCase()) :
                                    true;
                                return matchesRole && matchesSearch;
                            });
                        },
                        get paginatedAndFilteredUsers() {
                            const start = (this.currentPage - 1) * this.rowsPerPage;
                            const end = start + this.rowsPerPage;
                            return this.filteredUsers.slice(start, end);
                        },
                        get totalPages() {
                            return Math.ceil(this.filteredUsers.length / this.rowsPerPage);
                        },
                        async deleteUser(id) {
                            const confirmDelete = await Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: "Anda tidak akan dapat mengembalikan ini!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, hapus!'
                            });

                            if (confirmDelete.isConfirmed) {
                                try {
                                    const token = await axios.post('/token/get-token').then(res => res.data);
                                    const response = await axios.delete(`http://localhost:3000/api/teacher/${id}`, {
                                        headers: {
                                            'X-API-TOKEN': `${token}`
                                        }
                                    }).then(res => res.data);
                                    if (response.status === 201) {
                                        Swal.fire(
                                            'Dihapus!',
                                            'Pengguna telah dihapus.',
                                            'success'
                                        );
                                        this.users = this.users.filter(user => user.id !== id);
                                        if (this.paginatedAndFilteredUsers.length === 0 && this.currentPage > 1) {
                                            this.currentPage--;
                                        }
                                    }
                                } catch (error) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Pengguna gagal dihapus.',
                                        'error'
                                    );
                                }
                            }
                        }
                    }
                }
            </script>
            <x-users-update :admin="$admin" />
        </div>
    </x-admin-sidebar>
</x-admin-layout>
