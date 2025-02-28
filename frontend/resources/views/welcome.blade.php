{{-- {{ dd($news) }} --}}

<x-layout>
    <header class="fixed w-full z-50 backdrop-blur-sm shadow-sm">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                NextSiakad
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#" data-section="home"
                    class="nav-link hover:text-blue-600 font-bold transition-colors">Home</a>
                <a href="#" data-section="about"
                    class="nav-link hover:text-blue-600 font-bold transition-colors">About</a>
                <a href="#" data-section="ourteam"
                    class="nav-link hover:text-blue-600 font-bold transition-colors">Our Team</a>
                <a href="#" data-section="news"
                    class="nav-link hover:text-blue-600 font-bold transition-colors">News</a>
            </div>
            <a href="/auth/login"
                class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-full hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                Login
            </a>
        </nav>
    </header>
    <x-hero-section />
    <x-our-team />
    <section id="news" class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-8 text-center">Berita Terkini</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news['data'] as $new)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="http://localhost:3000/uploads/berita/{{ $new['gambar'] }}" alt="News {{ $new['judul'] }}"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $new['judul'] }}</h3>
                            <p class="text-gray-600 mb-4">{{ $new['konten'] }}</p>
                            <a href="#"
                                class="text-slate-600 hover:bg-slate-50 border border-slate-600 px-4 py-2 rounded inline-block">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-feedback />
    <x-maps />
    <x-footer-pages />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const texts = [
                "Mengubah Cara Pengelolaan Akademik Menjadi Lebih Efisien",
                "Sistem Informasi Akademik Modern dan Terintegrasi",
                "Solusi Terbaik untuk Manajemen Pendidikan",
                "Memudahkan Akses Informasi Akademik Dimana Saja"
            ];
            const typingText = document.getElementById('typing-text');
            let textIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            let typingSpeed = 50;

            function typeWriter() {
                const currentText = texts[textIndex];
                if (!isDeleting && charIndex <= currentText.length) {
                    typingText.innerHTML = currentText.substring(0, charIndex);
                    charIndex++;
                    typingSpeed = 50;
                } else if (isDeleting && charIndex >= 0) {
                    typingText.innerHTML = currentText.substring(0, charIndex);
                    charIndex--;
                    typingSpeed = 25;
                } else {
                    isDeleting = !isDeleting;
                    if (!isDeleting) {
                        textIndex = (textIndex + 1) % texts.length;
                    }
                    typingSpeed = isDeleting ? 2000 : 500;
                }
                setTimeout(typeWriter, typingSpeed);
            }
            typeWriter();
            document.querySelectorAll('.nav-link').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('data-section');
                    const element = document.getElementById(sectionId);

                    if (element) {
                        element.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</x-layout>
