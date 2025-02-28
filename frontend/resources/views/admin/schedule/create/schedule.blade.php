{{-- {{ dd($courses) }} --}}
<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Jadwal Mata Kuliah</h2>
                    <p class="mt-1 text-sm text-gray-600">Silahkan isi form berikut untuk menambah jadwal mata kuliah baru.</p>
                </div>

                <form class="p-6" id="scheduleForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <select name="course" id="course"
                                class="w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                                @foreach ($courses['data'] as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Hari</label>
                            <select name="day" id="day"
                                class="p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                                <option value="MONDAY">Senin</option>
                                <option value="TUESDAY">Selasa</option>
                                <option value="WEDNESDAY">Rabu</option>
                                <option value="THURSDAY">Kamis</option>
                                <option value="FRIDAY">Jumat</option>
                                <option value="SATURDAY">Sabtu</option>
                                <option value="SUNDAY">Minggu</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Ruangan</label>
                            <input type="text" name="room" id="room" placeholder="Masukkan nomor ruangan"
                                class="p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Waktu</label>
                            <div class="flex items-center space-x-2">
                                <input type="time" name="timeStart" id="timeStart"
                                    class="p-2 flex-1 rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                                <span class="text-gray-500">sampai</span>
                                <input type="time" name="timeEnd" id="timeEnd"
                                    class="p-2 flex-1 rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Dosen Pengajar</label>
                            <select name="teacher" id="dosen_pembimbing"
                                class="w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-ultramarine-500 focus:ring focus:ring-ultramarine-200">
                                @foreach ($teachers['data'] as $teacher)
                                    <option value="{{ $teacher['teacher']['id'] }}">{{ $teacher['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                        <a href="/admin/schedule"
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
            const formSchedule = document.querySelector('#scheduleForm');
            formSchedule.addEventListener('submit', async (e) => {
                e.preventDefault();
                const courseId = e.target.course.value;
                const day = e.target.day.value;
                const room = e.target.room.value;
                const timeStart = e.target.timeStart.value;
                const timeEnd = e.target.timeEnd.value;
                const time = `${timeStart}-${timeEnd}`;
                const teacherId = e.target.teacher.value;

                try {
                    const token = await axios.post('/token/get-token').then(res => res.data);
                    const response = await axios.post('http://localhost:3000/api/schedule/create', {
                        courseId: parseInt(courseId),
                        day,
                        room,
                        time,
                        teacherId: parseInt(teacherId),
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
                        window.location.replace('/admin/schedule')
                    }
                } catch (error) {
                    console.log(error);
                }
            })
        </script>
    </x-admin-sidebar>
</x-admin-layout>
