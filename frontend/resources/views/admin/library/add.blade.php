<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="flex h-screen bg-gray-100">
            <div class="flex-1 flex flex-col overflow-hidden">
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gray-800 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-white">Tambah Buku</h2>
                            </div>
                            <div class="p-6">
                                <form id="addBook">
                                    <div class="mb-4">
                                        <label for="title"
                                            class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                        <input type="text"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="title" id="title" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description"
                                            class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                        <input type="text"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="description" id="description" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="page"
                                            class="block text-gray-700 text-sm font-bold mb-2">Page</label>
                                        <input type="number"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="page" id="page" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="author"
                                            class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                                        <input type="text"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="author" id="author" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Cover
                                            Book</label>
                                        <input type="file"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="cover" id="cover">
                                    </div>
                                    <div class="mb-4">
                                        <label for="overview"
                                            class="block text-gray-700 text-sm font-bold mb-2">Overview</label>
                                        <textarea
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="overview" id="overview" rows="3"></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Add
                                        </button>
                                        <a
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('addBook');
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const formData = new FormData(form);
                    await axios.post('http://localhost:3000/api/library/create', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-API-TOKEN': await axios.post('/token/get-token').then(res => res
                                    .data)
                            }
                        })
                        .then(function(response) {
                            console.log(response.data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Book added successfully'
                            }).then(() => {
                                window.location.replace('/admin/service/perpustakaan');
                            });
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.response?.data.errors || error.message,
                            });
                        });
                });
            });
        </script>
    </x-admin-sidebar>
</x-admin-layout>
