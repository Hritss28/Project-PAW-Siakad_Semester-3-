{{-- {{ dd($enrollment, $evaluation) }} --}}

<x-layout>
    <x-student-layout :student="$student">
        <main class="ml-20 mr-20 mt-5">
            <div class="max-w-6xl mx-auto p-6">
                <a href="/student/sivitas" class="flex items-center text-gray-600 hover:text-gray-900 mb-6">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="border-b pb-4 mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $enrollment['data']['schedule']['course']['name'] }}</h1>
                        <p class="text-gray-600">{{ $enrollment['data']['schedule']['course']['code'] }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Dosen Pengampu</h3>
                            <p class="text-gray-800">{{ $enrollment['data']['schedule']['teacher']['user']['name'] }}</p>
                        </div>
                        {{-- <div>
                            <h3 class="text-sm font-medium text-gray-500">Semester</h3>
                            <p class="text-gray-800">Gasal 2024/2025</p>
                        </div> --}}
                    </div>
                </div>

                @if ($evaluation === null)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Form Evaluasi</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <form id="eval-form">
                                <div class="mb-4 ml-6 mr-6">
                                    <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai</label>
                                    <select name="nilai" id="nilai"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        required>
                                        <option value="">Pilih Nilai</option>
                                        <option value="S">S</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>

                                <div class="mb-4 ml-6 mr-6">
                                    <label for="komentar"
                                        class="block text-sm font-medium text-gray-700">Komentar</label>
                                    <textarea name="komentar" id="komentar" rows="4"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        required></textarea>
                                </div>

                                <div class="flex justify-end mr-6">
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 mt-5">
                        <div class="border-b pb-4 mb-4">
                            <h1 class="text-2xl font-bold text-gray-800">Riwayat Evaluasi</h1>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Nilai</h3>
                                <p class="text-gray-800">{{ $evaluation['data'][0]['nilai'] }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Komentar</h3>
                                <p class="text-gray-800">{{ $evaluation['data'][0]['komentar'] ?? 'Tidak ada komentar' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </main>
    </x-student-layout>
</x-layout>

<script>
    const evalForm = document.getElementById('eval-form');
    evalForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const enrollmentId = @json($enrollment['data']['id']);
        const nilai = document.getElementById('nilai').value;
        const komentar = document.getElementById('komentar').value;
        try {
            const token = await axios.post('/token/get-token').then(res => res.data);
            const response = await axios.post('http://localhost:3000/api/evaluation/create', {
                enrollmentId: parseInt(enrollmentId),
                nilai,
                komentar
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
                window.location.reload();
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response?.data.errors || error.message,
            })
        }
    })
</script>
