<x-dosen-layout :teacher="$teacher">
    <x-layout>
        <main class="ml-20 mr-20 mt-5">
            <div class="m-3 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 ">
                <div class="bg-white p-4 rounded-xl shadow-md w-full">
                    <h2 class="text-3xl font-extrabold text-gray-900">Data Berita</h2>
                    <p class="mt-2 text-lg text-gray-600">Kelola semua berita yang tersedia</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($news['data'] as $item)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="http://localhost:3000/uploads/berita/{{ $item['gambar'] }}"
                                alt="{{ $item['judul'] }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($item['createdAt'])->format('d F Y') }}
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                {{ $item['judul'] }}
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $item['konten'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </x-layout>
</x-dosen-layout>
    