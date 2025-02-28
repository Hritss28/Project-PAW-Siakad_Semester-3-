<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Tambah Pembayaran</h2>

                <form id="pembayaranForm" class="space-y-4">
                    <div class="mb-4">
                        <label for="semester" class="block text-gray-700 text-sm font-bold mb-2">
                            Semester
                        </label>
                        <select name="semester" id="semester"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Semester</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="semester_{{ $i }}">Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="total" class="block text-gray-700 text-sm font-bold mb-2">
                            Total Pembayaran
                        </label>
                        <input type="number" name="total" id="total"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan total pembayaran">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Tambah Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-admin-sidebar>
</x-admin-layout>

<script>
    const pembayaranForm = document.getElementById('pembayaranForm');
    pembayaranForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const semester = e.target.semester.value;
        const total = e.target.total.value;
        const token = await axios.post('/token/get-token').then(res => res.data);
        try {
            const response = await axios.post('http://localhost:3000/api/pembayaran/create', {
                semester,
                total: parseInt(total),
            }, {
                headers: {
                    'X-API-TOKEN': `${token}`
                }
            });
            if (response.status === 201) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.data.message,
                })
                window.location.replace('/admin/service');
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.response?.data.errors || error.message,
            })
        }
    });
</script>
