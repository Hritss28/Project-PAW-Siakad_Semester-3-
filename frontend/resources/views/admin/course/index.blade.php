<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div x-data="courseManagement()" class="container mx-auto px-6 py-10">
            <div class="bg-white shadow-lg rounded-xl">
                <div class="flex flex-col md:flex-row justify-between items-center p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Manajemen Mata Kuliah</h2>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/admin/users/create/course"
                            class="bg-ultramarine-500 hover:bg-ultramarine-600 text-white px-6 py-2.5 rounded-lg transition duration-300 text-center font-medium shadow-sm">
                            Tambah Mata Kuliah
                        </a>
                        <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ultramarine-500 focus:border-ultramarine-500" x-model="filterSemester">
                            <option value="">Semua Semester</option>
                            <option value="semester_1">Semester 1</option>
                            <option value="semester_2">Semester 2</option>
                            <option value="semester_3">Semester 3</option>
                            <option value="semester_4">Semester 4</option>
                            <option value="semester_5">Semester 5</option>
                            <option value="semester_6">Semester 6</option>
                            <option value="semester_7">Semester 7</option>
                            <option value="semester_8">Semester 8</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-ultramarine-800 to-ultramarine-900">
                                <th scope="col"
                                    class="px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    No</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    Nama Mata Kuliah</th>
                                <th scope="col"
                                    class="hidden sm:table-cell px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    Kode</th>
                                <th scope="col"
                                    class="hidden sm:table-cell px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    Program Studi</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    SKS</th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-4 text-left text-xs sm:text-sm font-semibold text-white">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(course, index) in paginatedCourses" :key="course.id">
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900"
                                        x-text="index + 1 + (currentPage - 1) * itemsPerPage">
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900"
                                        x-text="course.name">
                                    </td>
                                    <td class="hidden sm:table-cell px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900"
                                        x-text="course.code">
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900"
                                        x-text="course.programStudi">
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2 sm:px-3 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-ultramarine-100 text-ultramarine-800"
                                            x-text="course.sks">
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm">
                                        <div
                                            class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-4">
                                            <button @click="$dispatch('update-course-modal', {course : course})"
                                                class="text-blue-600 hover:text-blue-800 transition duration-150 font-medium flex items-center gap-1">
                                                <x-far-edit class="w-4 h-4" />
                                                <span class="hidden sm:inline">Ubah</span>
                                            </button>
                                            <button :data-id="course.code" @click="deleteCourse(course.code)"
                                                class="text-red-500 hover:text-red-700 transition duration-150 font-medium flex items-center gap-1">
                                                <x-ionicon-trash-outline class="w-4 h-4" />
                                                <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                            <button
                                                class="text-ultramarine-500 hover:text-ultramarine-700 transition duration-150 font-medium flex items-center gap-1"
                                                @click="openModal(course.id)">
                                                <x-ionicon-document-text-outline class="w-4 h-4" />
                                                <span class="hidden sm:inline">Detail</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Controls -->
                <div class="px-6 py-4 flex items-center justify-between border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button @click="currentPage = currentPage - 1" :disabled="currentPage === 1"
                            :class="{'opacity-50 cursor-not-allowed': currentPage === 1}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </button>
                        <button @click="currentPage = currentPage + 1" :disabled="currentPage === totalPages"
                            :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}"
                            class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing page
                                <span class="font-medium" x-text="currentPage"></span>
                                of
                                <span class="font-medium" x-text="totalPages"></span>
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <!-- Previous Button -->
                                <button @click="currentPage = currentPage - 1" :disabled="currentPage === 1"
                                    :class="{'opacity-50 cursor-not-allowed': currentPage === 1}"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Page Numbers -->
                                <template x-for="page in totalPages" :key="page">
                                    <button @click="currentPage = page"
                                        :class="{
                                            'bg-ultramarine-50 border-ultramarine-500 text-ultramarine-600': currentPage === page,
                                            'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': currentPage !== page
                                        }"
                                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                        x-text="page">
                                    </button>
                                </template>

                                <!-- Next Button -->
                                <button @click="currentPage = currentPage + 1" :disabled="currentPage === totalPages"
                                    :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function courseManagement() {
                return {
                    courses: @json($courses['data']),
                    currentPage: 1,
                    itemsPerPage: 10,
                    filterSemester: "",
                    semesters: ['semester_1', 'semester_2', 'semester_3', 'semester_4'],

                    get paginatedCourses() {
                        let filteredCourses = this.courses;

                        // Filter by semester if applicable
                        if (this.filterSemester) {
                            filteredCourses = filteredCourses.filter(
                                course => course.semester === this.filterSemester
                            );
                        }

                        // Pagination logic
                        const start = (this.currentPage - 1) * this.itemsPerPage;
                        const end = start + this.itemsPerPage;
                        return filteredCourses.slice(start, end);
                    },

                    get totalPages() {
                        const filteredCourses = this.filterSemester ?
                            this.courses.filter(course => course.semester === this.filterSemester) :
                            this.courses;

                        return Math.ceil(filteredCourses.length / this.itemsPerPage);
                    },


                    async deleteCourse(courseCode) {
                        const token = await axios.post('/token/get-token').then(res => res.data);
                        
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data mata kuliah ini akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                try {
                                    await axios.delete(`http://localhost:3000/api/course/${courseCode}`, {
                                        headers: {
                                            'X-API-TOKEN': `${token}`
                                        }
                                    });
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data mata kuliah telah dihapus.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } catch (error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: error.response?.data.errors || 'Terjadi kesalahan saat menghapus data.',
                                    });
                                }
                            }
                        });
                    }
                }
            }
        </script>
    </x-admin-sidebar>
</x-admin-layout>

{{-- Pop up Modal --}}
<x-course-modal :courses="$courses['data']" />
<x-course-update />
