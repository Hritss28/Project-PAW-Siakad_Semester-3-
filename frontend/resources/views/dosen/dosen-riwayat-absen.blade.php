{{-- {{ dd($absences) }} --}}

<x-layout>
    <x-dosen-layout :teacher="$teacher">
        <div class="container mx-auto p-6">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Riwayat Absensi</h1>
                <p class="text-gray-600">Kelola kehadiran mahasiswa</p>
                <div class="mt-4 no-print">
                    <button id="print-button"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak PDF
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 print-container">
                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mahasiswa</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NIM</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider no-print">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($absences['data'] as $absence)
                                    <tr class="hover:bg-gray-50">
                                        <input type="hidden" name="studentId" id="studentId"
                                            value="{{ $absence['student']['id'] }}">
                                        <input type="hidden" name="scheduleId" id="scheduleId"
                                            value="{{ $absence['schedule']['id'] }}">
                                        <input type="hidden" name="pertemuan" id="pertemuan"
                                            value="{{ $absence['pertemuan'] }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $absence['student']['user']['name'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $absence['student']['nim'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($absence['updatedAt'])->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $absence['statusKehadiran'] == 'HADIR' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $absence['statusKehadiran'] == 'IZIN' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $absence['statusKehadiran'] == 'ALPA' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $absence['statusKehadiran'] == 'SAKIT' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                {{ $absence['statusKehadiran'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm no-print">
                                            <select
                                                class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 status">
                                                <option {{ $absence['statusKehadiran'] == 'HADIR' ? 'selected' : '' }}
                                                    value="HADIR">Hadir</option>
                                                <option {{ $absence['statusKehadiran'] == 'IZIN' ? 'selected' : '' }}
                                                    value="IZIN">Izin</option>
                                                <option {{ $absence['statusKehadiran'] == 'SAKIT' ? 'selected' : '' }}
                                                    value="SAKIT">Sakit</option>
                                                <option {{ $absence['statusKehadiran'] == 'ALPA' ? 'selected' : '' }}
                                                    value="ALPA">Alpa</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @media print {

                /* Reset all visibility */
                body * {
                    visibility: hidden;
                }

                /* Show only printable content */
                .print-container,
                .print-container * {
                    visibility: visible;
                }

                /* Hide elements with no-print class */
                .no-print {
                    display: none !important;
                }

                /* Position the printable content */
                .print-container {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                /* Table styling for print */
                table {
                    border-collapse: collapse;
                    width: 100%;
                    margin: 20px 0;
                }

                th,
                td {
                    border: 1px solid #000 !important;
                    padding: 12px !important;
                    text-align: left;
                }

                th {
                    background-color: #f3f4f6 !important;
                    -webkit-print-color-adjust: exact;
                }

                /* Status badges styling for print */
                .rounded-full {
                    border-radius: 0 !important;
                    padding: 2px 8px !important;
                    -webkit-print-color-adjust: exact;
                }

                /* Keep status colors in print */
                .bg-green-100 {
                    background-color: #dcfce7 !important;
                }

                .bg-blue-100 {
                    background-color: #dbeafe !important;
                }

                .bg-red-100 {
                    background-color: #fee2e2 !important;
                }

                .bg-yellow-100 {
                    background-color: #fef9c3 !important;
                }

                /* Remove shadows and rounds for print */
                .shadow-sm {
                    box-shadow: none !important;
                }

                .rounded-lg {
                    border-radius: 0 !important;
                }
            }
        </style>

        <script>
            document.getElementById('print-button').addEventListener('click', () => {
                window.print();
            });

            const statusSelect = document.querySelectorAll('.status');
            statusSelect.forEach(element => {
                element.addEventListener('change', async (e) => {
                    try {
                        const studentId = element.parentElement.parentElement.querySelector('#studentId')
                            .value;
                        const scheduleId = element.parentElement.parentElement.querySelector('#scheduleId')
                            .value;
                        const pertemuan = element.parentElement.parentElement.querySelector('#pertemuan')
                            .value;
                        const status = e.target.value;
                        const token = await axios.post('/token/get-token').then(res => res.data);
                        const response = await axios.patch(
                            `http://localhost:3000/api/absensi/teacher/`, {
                                studentId: parseInt(studentId),
                                scheduleId: parseInt(scheduleId),
                                pertemuan: parseInt(pertemuan),
                                statusKehadiran: status
                            }, {
                                headers: {
                                    'X-API-TOKEN': `${token}`
                                }
                            }).then(data => data.data);
                        if (response.status === 201) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: response.message,
                            }).then(() => {
                                window.location.reload();
                            })
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: error.response.data.errors || error.message,
                        })
                    }
                });
            });
        </script>
    </x-dosen-layout>
</x-layout>
