{{-- {{ dd($alumni) }} --}}
<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="p-4">
            <!-- Form Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">Tambah Data Alumni</h2>

                <form id="alumniForm" onsubmit="handleSubmit(event)">
                    <div class="mb-4">
                        <label for="studentId" class="block text-gray-700 font-medium mb-2">Mahasiswa</label>
                        <select name="studentId" id="studentId"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach ($students['data'] as $student)
                                <option value="{{ $student['student']['id'] }}">{{ $student['name'] }} -
                                    {{ $student['student']['nim'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tanggalLulus" class="block text-gray-700 font-medium mb-2">Tanggal Lulus</label>
                        <input type="date" name="tanggalLulus" id="tanggalLulus"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Data Alumni</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Lulus</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pekerjaan</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perusahaan</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($alumni['data'] as $alumniData)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($students['data'] as $student)
                                            @if ($student['student']['id'] == $alumniData['studentId'])
                                                {{ $student['student']['nim'] }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($students['data'] as $student)
                                            @if ($student['student']['id'] == $alumniData['studentId'])
                                                {{ $student['name'] }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($alumniData['tanggalLulus'])->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $alumniData['pekerjaan'] ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $alumniData['perusahaan'] ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            onclick="openEditModal({{ json_encode($alumniData) }})"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 mr-2">
                                            Edit
                                        </button>
                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            onclick="handleDelete({{ $alumniData['id'] }})"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Alumni</h3>
                    <form id="editForm" class="mt-4">
                        <input type="hidden" id="editId">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Pekerjaan</label>
                            <input type="text" id="editPekerjaan"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Perusahaan</label>
                            <input type="text" id="editPerusahaan"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="button" onclick="closeEditModal()"
                                class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-admin-sidebar>

    <script>
        async function handleSubmit(e) {
            e.preventDefault();

            const studentId = document.getElementById('studentId').value;
            const tanggalLulus = document.getElementById('tanggalLulus').value;

            const tanggalLulusDate = new Date(tanggalLulus);
            const token = await axios.post('/token/get-token').then(res => res.data);
            try {
                const response = await axios.post('http://localhost:3000/api/alumni/create', {
                    studentId: parseInt(studentId),
                    tanggalLulus: tanggalLulusDate.toISOString(),
                }, {
                    headers: {
                        'X-API-TOKEN': `${token}`,
                    },
                });

                if (response.status === 201) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.data.message,
                    }).then(() => {
                        window.location.replace('/admin/service/alumni');
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: error.response?.data.errors || error.message,
                });
            }
        }

        function openEditModal(alumni) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editId').value = alumni.id;
            document.getElementById('editPekerjaan').value = alumni.pekerjaan || '';
            document.getElementById('editPerusahaan').value = alumni.perusahaan || '';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('editId').value;
            const pekerjaan = document.getElementById('editPekerjaan').value;
            const perusahaan = document.getElementById('editPerusahaan').value;

            const token = await axios.post('/token/get-token').then(res => res.data);
            try {
                const response = await axios.patch(`http://localhost:3000/api/alumni/update/${id}`, {
                    pekerjaan,
                    perusahaan
                }, {
                    headers: {
                        'X-API-TOKEN': `${token}`,
                    },
                });

                if (response.status === 201) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Alumni updated successfully",
                    }).then(() => {
                        window.location.reload();
                    });
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

        async function handleDelete(id) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (result.isConfirmed) {
                const token = await axios.post('/token/get-token').then(res => res.data);
                try {
                    const response = await axios.delete(`http://localhost:3000/api/alumni/${id}`, {
                        headers: {
                            'X-API-TOKEN': `${token}`,
                        },
                    });

                    if (response.status === 201) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Alumni deleted successfully",
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: error.response?.data.errors || error.message,
                    });
                }
            }
        }
    </script>
</x-admin-layout>
