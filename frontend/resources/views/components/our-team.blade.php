@props([
    'ourTeam' => [
        [
            'name' => 'Imam Syafii',
            'role' => 'Ctrl+C Ctrl+V Developer',
            'img' => 'images/imam.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => 'https://www.linkedin.com/in/imamgg',
            'twitter' => 'https://x.com/404imam',
            'github' => 'https://github.com/Imamgg',
            'portfolio' => 'https://imamgg-dev.vercel.app/',
        ],
        [
            'name' => 'Ahmad Mufid Risqi',
            'role' => 'Fullstack Developer',
            'img' => 'images/mufid.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => 'https://www.linkedin.com/in/coding-with-mufid/',
            'twitter' => 'https://x.com/MufidRisqi30683',
            'github' => 'https://github.com/Mufid-031',
            'portfolio' => 'https://coding-with-mufid.vercel.app/',
        ],
        [
            'name' => 'Ach. Lutfi Madani',
            'role' => 'Fullstack Developer',
            'img' => 'images/lutfi.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => '#',
            'twitter' => 'https://x.com/adlhorgygbeda?t=FyPyEZdKrTSObn6goH3acw&s=09',
            'github' => 'https://github.com/AchmadLutfi196',
            'portfolio' => '#',
        ],
        [
            'name' => 'Harits Putra Junaidi',
            'role' => 'Frontend Developer',
            'img' => 'images/harits.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => 'https://www.linkedin.com/in/harits-putra-junaidi-643803296',
            'twitter' => '#',
            'github' => 'https://github.com/Haritss28',
            'portfolio' => '#',
        ],
        [
            'name' => 'M. Javier Akmal Hadi',
            'role' => 'Frontend Developer',
            'img' => 'images/javier.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => 'https://www.linkedin.com/in/m-javier',
            'twitter' => '#',
            'github' => 'https://github.com/javiernindis1',
            'portfolio' => '#',
        ],
        [
            'name' => 'Moh. Ariel Rifqi Ahsan',
            'role' => 'Frontend Developer',
            'img' => 'images/ariel.jpg',
            'university' => 'Universitas Trunojoyo Madura',
            'linkedIn' => '#',
            'twitter' => '#',
            'github' => 'https://github.com/arielahsan',
            'portfolio' => '#',
        ],
    ],
])

<section id="ourteam" class="py-24 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-gray-900 text-center mb-16">Our Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($ourTeam as $team)
                <div
                    class="bg-white rounded-xl shadow-lg p-8 text-center group relative transform transition-all duration-300 hover:-translate-y-2">
                    <div class="relative overflow-hidden rounded-xl mb-6">
                        <div class="aspect-square">
                            <img src="{{ asset($team['img']) }}" alt="Team Member"
                                class="aspect-square transition duration-300 group-hover:scale-105">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-4">
                                @if ($team['twitter'] !== '#')
                                    <a href="{{ $team['linkedIn'] }}"
                                        class="bg-[#0077b5] p-2 rounded-full text-white hover:bg-opacity-80 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" role="img" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($team['twitter'] !== '#')
                                    <a href="{{ $team['twitter'] }}"
                                        class="bg-[#1DA1F2] p-2 rounded-full text-white hover:bg-opacity-80 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" role="img" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($team['github'] !== '#')
                                    <a href="{{ $team['github'] }}"
                                        class="bg-[#171515] p-2 rounded-full text-white hover:bg-opacity-80 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" role="img" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($team['portfolio'] !== '#')
                                    <a href="{{ $team['portfolio'] }}"
                                        class="bg-[#171515] p-2 rounded-full text-white hover:bg-opacity-80 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $team['name'] }}</h3>
                    <p class="text-gray-600">{{ $team['role'] }}</p>
                    <p class="text-blue-600">{{ $team['university'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
