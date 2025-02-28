<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Mata Kuliah</h2>
                </div>
                <form class="space-y-6" id="courseForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Nama Matkul</label>
                            <input type="text" name="name"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Kode Matkul</label>
                            <input type="text" name="code"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Dosen Pengajar</label>
                            <select name="teacher" id="dosen_pembimbing"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
                                @foreach ($teachers['data'] as $teacher)
                                    <option value="{{ $teacher['teacher']['id'] }}">{{ $teacher['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Jumlah SKS</label>
                            <select name="sks"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
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

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" name="program_studi"
                                class="w-full p-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ultramarine-400 focus:border-ultramarine-400">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                        <a href="/admin/course"
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
            const formCourse = document.querySelector('#courseForm');
            formCourse.addEventListener('submit', async (e) => {
                e.preventDefault();
                const name = e.target.name.value;
                const code = e.target.code.value;
                const teacherId = e.target.teacher.value;
                const sks = e.target.sks.value;
                const semester = e.target.semester.value;
                const programStudi = e.target.program_studi.value;

                try {
                    const token = await axios.post('/token/get-token').then(res => res.data);
                    const response = await axios.post('http://localhost:3000/api/course/create', {
                        name,
                        code,
                        teacherId: parseInt(teacherId),
                        sks: parseInt(sks),
                        semester,
                        programStudi,
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
                        window.location.replace('/admin/course')
                    }
                } catch (error) {
                    console.log(error);
                }
            })
        </script>
    </x-admin-sidebar>
</x-admin-layout>
