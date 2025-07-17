<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'DonaSangre'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Meta description for SEO -->
        <meta name="description" content="Plataforma para conectar mascotas donantes de sangre con casos de emergencia veterinaria. Registra tu mascota como donante y ayuda a salvar vidas.">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Flash Messages -->
            @if(session('success'))
                <div id="flash-success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 relative max-w-7xl mx-auto mt-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="closeFlashMessage('flash-success')" class="text-green-400 hover:text-green-600">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div id="flash-error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 relative max-w-7xl mx-auto mt-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 10.586l1.293 1.293a1 1 0 001.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="closeFlashMessage('flash-error')" class="text-red-400 hover:text-red-600">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <div class="flex items-center mb-4">
                                <span class="text-2xl">🩸</span>
                                <span class="ml-2 text-xl font-bold">DonaSangre</span>
                                <span class="ml-1 text-lg">🐾</span>
                            </div>
                            <p class="text-gray-300 text-sm">
                                Plataforma dedicada a conectar mascotas donantes de sangre con casos de emergencia veterinaria. 
                                Juntos salvamos vidas.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Enlaces Útiles</h3>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('blood-donors.index') }}" class="text-gray-300 hover:text-white transition-colors">Donantes Disponibles</a></li>
                                <li><a href="{{ route('blood-donors.create') }}" class="text-gray-300 hover:text-white transition-colors">Registrar Donante</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Información sobre Donación</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contacto</a></li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Emergencias</h3>
                            <p class="text-gray-300 text-sm mb-2">
                                En caso de emergencia veterinaria, contacta inmediatamente a tu veterinario de confianza.
                            </p>
                            <p class="text-red-400 font-medium text-sm">
                                ⚠️ Esta plataforma es un complemento, no un reemplazo de la atención veterinaria profesional.
                            </p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                        <p class="text-gray-400 text-sm">
                            © {{ date('Y') }} DonaSangre. Desarrollado con ❤️ para salvar vidas de mascotas.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            // Close flash messages
            function closeFlashMessage(id) {
                document.getElementById(id).style.display = 'none';
            }

            // Auto-hide flash messages after 5 seconds
            setTimeout(function() {
                const successMsg = document.getElementById('flash-success');
                const errorMsg = document.getElementById('flash-error');
                
                if (successMsg) {
                    successMsg.style.opacity = '0';
                    setTimeout(() => successMsg.style.display = 'none', 300);
                }
                
                if (errorMsg) {
                    errorMsg.style.opacity = '0';
                    setTimeout(() => errorMsg.style.display = 'none', 300);
                }
            }, 5000);
        </script>

        @stack('scripts')
    </body>
</html>