<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script type="importmap">
            {
              "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@v0.149.0/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@v0.149.0/examples/jsm/"
              }
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

        

        <!-- Scripts -->


        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html {
                scroll-behavior: smooth;
            }
        
            body {
                margin: 0;
            }
        </style>
        
    </head>
    <body class="bg-white dark:bg-gray-900">
        
        
        
        <main class="">
            
            <button id="toggleDarkMode" class="p-2 rounded focus:outline-none fixed bottom-4 right-4 z-50">
                <img id="sunIcon" src="https://cdn-icons-png.flaticon.com/512/12657/12657273.png" class="w-12 text-yellow-500 dark:hidden" width="512" height="512" alt="SunIcon"/>
                <img id="moonIcon" src="https://cdn-icons-png.flaticon.com/512/12657/12657213.png" class="w-12 text-gray-300 hidden dark:inline" width="512" height="512" alt="MoonIcon"/>
            </button>
            
            <x-header />
            <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                <x-hero-section/>
                <x-features/>
                <x-modales/>
            </div>
            <x-footer/>
        </main>

        {{-- <div class="fixed inset-x-6 bottom-6 z-40 mx-auto w-max">
            <a href="https://tailus.gumroad.com/l/astls-premium" target="_blank" class="flex gap-3 rounded-2xl border border-yellow-900/30 bg-gradient-to-br from-white/50 to-yellow-100 p-3 shadow-2xl shadow-yellow-900/50 backdrop-blur-xl dark:border-white/10 dark:from-gray-800 dark:to-black/70 dark:shadow-primary/50">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-yellow-600 dark:text-yellow-500">
                    <path fill-rule="evenodd" d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5zM18 1.5a.75.75 0 01.728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 010 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 01-1.456 0l-.258-1.036a2.625 2.625 0 00-1.91-1.91l-1.036-.258a.75.75 0 010-1.456l1.036-.258a2.625 2.625 0 001.91-1.91l.258-1.036A.75.75 0 0118 1.5zM16.5 15a.75.75 0 01.712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 010 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 01-1.422 0l-.395-1.183a1.5 1.5 0 00-.948-.948l-1.183-.395a.75.75 0 010-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0116.5 15z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-semibold tracking-wide text-yellow-900 dark:text-white"> Upgrade to Premium</span>
            </a>
        </div> --}}







        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script>
            const modelUrl = "{{ asset('scene.gltf') }}";
        </script>
        <script type="module" src="{{ asset('js/main.js') }}"></script>
        <script>
        AOS.init();
        </script>

        

        <script>
            const toggleDarkMode = document.getElementById('toggleDarkMode');

            // Alternar entre modo claro y oscuro
            toggleDarkMode.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark'); // Alternar la clase 'dark' en el <html>

                // Guardar la preferencia del usuario en localStorage
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });

            // Configurar el tema inicial al cargar la página
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </body>

    
</html>
