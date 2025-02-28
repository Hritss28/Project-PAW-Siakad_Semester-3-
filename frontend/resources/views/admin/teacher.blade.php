<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-8" x-data="teacherManagement()">
            <div class="mb-8 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-1">
                        <input type="text" x-model="searchQuery" @input="filterTeachers"
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition-all duration-200"
                            placeholder="Cari dosen...">
                        <div class="absolute left-4 top-3.5 text-gray-400">
                            <x-ionicon-search-outline class="w-5 h-5" />
                        </div>
                    </div>
                    <select x-model="selectedFaculty" @change="filterTeachers"
                        class="min-w-[200px] py-3 px-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-ultramarine-200 focus:border-ultramarine-400 transition-all duration-200">
                        <option value="">Semua Fakultas</option>
                        <option value="Teknik">Fakultas Teknik</option>
                        <option value="lainnya">Fakultas Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="(teacher, index) in paginatedTeachers" :key="teacher.id">
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden group">
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="bg-gradient-to-br from-ultramarine-50 to-ultramarine-100 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                    <x-ionicon-person-circle-outline class="w-8 h-8 text-ultramarine-600" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-ultramarine-600 transition-colors duration-200 truncate"
                                        x-text="teacher.name"></h3>
                                    <p class="text-sm text-gray-500 mt-1" x-text="`NIP: ${teacher.teacher.nip}`"></p>
                                </div>
                            </div>

                            <div class="mt-4 space-y-3">
                                <div class="flex items-center gap-3 text-gray-600">
                                    <x-ionicon-mail-outline class="w-5 h-5 text-gray-400" />
                                    <span class="text-sm truncate" x-text="teacher.email"></span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <x-ionicon-school-outline class="w-5 h-5 text-gray-400" />
                                    <span class="text-sm" x-text="`Fakultas ${teacher.teacher.fakultas}`"></span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button @click="openModal(teacher.id)"
                                    class="w-full py-2.5 px-4 bg-ultramarine-50 text-ultramarine-600 rounded-xl hover:bg-ultramarine-100 transition-colors duration-200 flex items-center justify-center gap-2 group">
                                    <x-far-eye class="w-4 h-4" />
                                    <span>Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pagination Section -->
            <div class="mt-8 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Showing <span x-text="((currentPage - 1) * rowsPerPage) + 1"></span>
                        to <span x-text="Math.min(currentPage * rowsPerPage, filteredTeachers.length)"></span>
                        of <span x-text="filteredTeachers.length"></span> entries
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
                                        'bg-ultramarine-500 text-white border-ultramarine-500': currentPage === page,
                                        'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': currentPage !== page
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

        <script>
            function teacherManagement() {
                return {
                    teachers: @json($teachers['data']),
                    filteredTeachers: [],
                    currentPage: 1,
                    rowsPerPage: 9,
                    searchQuery: '',
                    selectedFaculty: '',

                    init() {
                        this.filteredTeachers = this.teachers;
                        this.filterTeachers();
                    },

                    get paginatedTeachers() {
                        const start = (this.currentPage - 1) * this.rowsPerPage;
                        const end = start + this.rowsPerPage;
                        return this.filteredTeachers.slice(start, end);
                    },

                    get totalPages() {
                        return Math.ceil(this.filteredTeachers.length / this.rowsPerPage);
                    },

                    filterTeachers() {
                        this.filteredTeachers = this.teachers.filter(teacher => {
                            const searchMatch = this.searchQuery === '' || 
                                teacher.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                teacher.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                teacher.teacher.nip.toString().includes(this.searchQuery.toLowerCase());
                                
                            const facultyMatch = this.selectedFaculty === '' || 
                                teacher.teacher.fakultas.toLowerCase() === this.selectedFaculty.toLowerCase();

                            return searchMatch && facultyMatch;
                        });
                        this.currentPage = 1;
                    }
                }
            }
        </script>
        <x-teacher-modal :teachers="$teachers['data']" />
    </x-admin-sidebar>
</x-admin-layout>
