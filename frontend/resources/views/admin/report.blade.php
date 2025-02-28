<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8 bg-gradient-to-br from-blue-50 to-indigo-50">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2 inline-block">Laporan
                    Akademik</h1>
                <button onclick="generatePDF()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Cetak PDF
                </button>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg mb-8 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-700 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Nilai Terkini
                        </h2>
                        <span class="text-red-500 text-sm italic">* Data ini diperbarui setiap 3 tahun sekali</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-blue-500 to-indigo-600">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Mata Kuliah</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        2022</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        2023</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        2024</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-700">Pengembangan
                                        Aplikasi
                                        Web</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">78</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">81</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">95</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-green-600 font-semibold">84</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-700">Basis Data</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">80</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">74</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">86</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-green-600 font-semibold">80</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-700">Pemrograman
                                        Desktop</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">78</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">81</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">84</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-green-600 font-semibold">81</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                    class="bg-white rounded-xl shadow-lg transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-700 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                            Grafik Performa Akademik
                        </h2>
                        <div class="h-96 bg-gradient-to-br from-white to-gray-50 rounded-lg p-4">
                            <canvas id="academicChart"></canvas>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-700 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Grafik Detail Transaksi
                        </h2>
                        <div class="h-96 bg-gradient-to-br from-white to-gray-50 rounded-lg p-4">
                            <canvas id="transactionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <script>
            function generatePDF() {
                const element = document.querySelector('.container');
                const opt = {
                    margin: 1,
                    filename: 'laporan-akademik.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                html2pdf().set(opt).from(element).save();
            }

            const academicCtx = document.getElementById('academicChart').getContext('2d');
            new Chart(academicCtx, {
                type: 'line',
                data: {
                    labels: ['2021', '2022', '2023'],
                    datasets: [{
                            label: 'Pengembangan Aplikasi Web',
                            data: [80, 75, 95],
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        },
                        {
                            label: 'Basis Data',
                            data: [80, 74, 86],
                            borderColor: 'rgb(255, 99, 132)',
                            tension: 0.1
                        },
                        {
                            label: 'Pemrograman Desktop',
                            data: [78, 81, 84],
                            borderColor: 'rgb(153, 102, 255)',
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 0,
                            max: 100
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Perkembangan Nilai Rata-Rata Per Tahun (2021-2023)'
                        }
                    }
                }
            });

            const payments = @json($payments['data']);
            const monthlyTotals = {};
            payments.forEach(payment => {
                const date = new Date(payment.createdAt);
                const month = date.toLocaleString('default', {
                    month: 'long'
                });
                monthlyTotals[month] = (monthlyTotals[month] || 0) + payment.total;
            });
            const transactionCtx = document.getElementById('transactionChart').getContext('2d');
            new Chart(transactionCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(monthlyTotals),
                    datasets: [{
                        label: 'Total Transaksi',
                        data: Object.values(monthlyTotals),
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Detail Transaksi Bulanan'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </x-admin-sidebar>
</x-admin-layout>
