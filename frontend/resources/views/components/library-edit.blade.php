<div id="editLibraryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="flex flex-col">
            <div class="flex justify-between items-center pb-4 mb-4 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Edit Library</h3>
                <button onclick="closeEditLibraryModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="editLibraryForm" class="space-y-4">
                <input type="hidden" id="libraryId">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" id="author" name="author"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="page" class="block text-sm font-medium text-gray-700">Pages</label>
                    <input type="number" id="page" name="page"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="6"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <div>
                    <label for="cover" class="block text-sm font-medium text-gray-700">Cover Image</label>
                    <input type="file" id="cover" name="cover"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditLibraryModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="button" onclick="submitEditLibrary()"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditLibraryModal(id, title, author, page, description, cover) {
        document.getElementById('libraryId').value = id;
        document.getElementById('title').value = title;
        document.getElementById('author').value = author;
        document.getElementById('page').value = page;
        document.getElementById('description').value = description;
        document.getElementById('editLibraryModal').classList.remove('hidden');
    }

    function closeEditLibraryModal() {
        document.getElementById('editLibraryModal').classList.add('hidden');
        document.getElementById('editLibraryForm').reset();
    }

    async function submitEditLibrary() {
        const id = document.getElementById('libraryId').value;
        const title = document.getElementById('title').value;
        const author = document.getElementById('author').value;
        const page = document.getElementById('page').value;
        const description = document.getElementById('description').value;
        const cover = document.getElementById('cover').files[0];
        try {
            const token = await axios.post('/token/get-token').then(res => res.data);
            const response = await axios.patch(`http://localhost:3000/api/library`, {
                id,
                title,
                author,
                page: parseInt(page),
                description,
                cover
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-API-TOKEN': `${token}`,
                }
            });
            if (response.status === 201) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Library item updated successfully",
                }).then(() => {
                    window.location.reload();
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.response?.data.errors || error.message,
            });
        }
    }
</script>
