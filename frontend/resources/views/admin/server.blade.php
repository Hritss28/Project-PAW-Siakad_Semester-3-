{{-- {{ dd($server) }} --}}

<x-admin-layout>
    <x-admin-sidebar :admin="$admin">
        <div class="container mx-auto px-4 py-8">
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-3xl font-bold mb-6">Server Status</h1>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left pb-4 text-gray-700 font-semibold">Server Name</th>
                            <th class="text-left pb-4 text-gray-700 font-semibold">Status</th>
                            <th class="text-left pb-4 text-gray-700 font-semibold">Action</th>
                            <th class="text-left pb-4 text-gray-700 font-semibold">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2">
                                <span class="text-gray-800 font-medium">{{ $server['name'] ?? 'Main Server' }}</span>
                            </td>
                            <td class="py-2">
                                <span id="serverStatus" class="px-2 py-1 rounded text-white font-semibold">
                                    @if (!$server['data']['isMaintenance'])
                                        <span class="bg-green-500 p-2 rounded-full">Online</span>
                                    @else
                                        <span class="bg-red-500 p-2 rounded-full">Offline</span>
                                    @endif
                                </span>
                            </td>
                            <td class="py-2">
                                <label for="toggleServer" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="toggleServer" class="sr-only"
                                            {{ $server['data']['isMaintenance'] ? 'checked' : '' }}>
                                        <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                        <div
                                            class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition">
                                        </div>
                                    </div>
                                    <div id="toggleLabel" class="ml-3 text-gray-700 font-medium">
                                        {{ $server['data']['isMaintenance'] ? 'Online' : 'Offline' }}
                                    </div>
                                </label>
                            </td>
                            <td>
                                <span class="text-gray-800 font-medium">
                                    {{ $server['message'] ?? 'No message' }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <style>
            input:checked~.dot {
                transform: translateX(100%);
            }

            input:checked~div .bg-gray-400 {
                background-color: #48bb78;
            }
        </style>

        <script>
            const toggleSwitch = document.getElementById('toggleServer');
            const statusSpan = document.getElementById('serverStatus');
            const toggleLabel = document.getElementById('toggleLabel');

            toggleSwitch.addEventListener('change', async () => {
                try {
                    const response = await axios.patch('http://localhost:3000/maintenance/toggle-maintenance');
                    console.log(response);
                    if (response.data) {
                        statusSpan.innerHTML = '<span class="bg-green-500 p-2 rounded-full">Online</span>';
                        toggleLabel.textContent = 'Online';
                    } else {
                        statusSpan.innerHTML = '<span class="bg-red-500 p-2 rounded-full">Offline</span>';
                        toggleLabel.textContent = 'Offline';
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then(() => {
                        window.location.reload();
                    });
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data.errors || error.message
                    });
                    toggleSwitch.checked = !toggleSwitch.checked; // Revert the toggle if there's an error
                }
            });
        </script>
    </x-admin-sidebar>
</x-admin-layout>
