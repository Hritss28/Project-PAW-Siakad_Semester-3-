<section id="feedback" class="py-20 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold mb-8 text-center text-gray-800">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Feedback Anda</span>
        </h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Kami sangat menghargai masukan Anda untuk
            meningkatkan layanan kami</p>

        <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-2xl backdrop-blur-lg backdrop-filter">
            <form id="feedbackForm" class="space-y-6">
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input type="text" id="name" name="name"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300"
                            placeholder="Masukkan nama Anda">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input type="email" id="email" name="email"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300"
                            placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="message" class="block text-sm font-semibold text-gray-700">Pesan</label>
                    <div class="relative">
                        <span class="absolute left-0 top-3 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </span>
                        <textarea id="message" name="message" rows="4"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300"
                            placeholder="Tulis pesan Anda di sini"></textarea>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 rounded-full text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span>Kirim Pesan</span>
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const feedbackForm = document.getElementById('feedbackForm');
    feedbackForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = e.target.name.value;
        const email = e.target.email.value;
        const pesan = e.target.message.value;

        try {
            const response = await axios.post('http://localhost:3000/api/kritikSaran/create', {
                name,
                email,
                pesan
            });
            if (response.status === 201) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Terima kasih atas masukan Anda",
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
            })
        }
    });
</script>
