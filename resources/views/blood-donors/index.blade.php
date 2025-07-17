@extends('layouts.app')

@section('title', 'Donantes de Sangre Disponibles')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-pink-100">
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    🩸 Donantes de Sangre Disponibles 🐾
                </h1>
                <p class="text-lg text-gray-600 mb-6">
                    Encuentra donantes de sangre para tu mascota en situación de emergencia
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('blood-donors.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Registrar mi mascota como donante
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{-- Estadísticas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $donors->total() }}</div>
                <div class="text-gray-600">Donantes Disponibles</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $donors->where('animal_species', 'perro')->count() }}</div>
                <div class="text-gray-600">Perros Donantes</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $donors->where('animal_species', 'gato')->count() }}</div>
                <div class="text-gray-600">Gatos Donantes</div>
            </div>
        </div>

        @if($donors->count() > 0)
            {{-- Grid de Donantes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($donors as $donor)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        {{-- Foto del Animal --}}
                        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                            @if($donor->animal_photo_url)
                                <img src="{{ $donor->animal_photo_url }}" 
                                     alt="Foto de {{ $donor->animal_name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Información del Animal --}}
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $donor->animal_name }}</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $donor->animal_species == 'perro' ? 'bg-blue-100 text-blue-800' : 
                                       ($donor->animal_species == 'gato' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $donor->formatted_species }}
                                </span>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span>{{ $donor->animal_breed }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $donor->animal_age }} años</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                    </svg>
                                    <span>{{ $donor->animal_weight }} kg</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-green-600 font-medium">{{ $donor->formatted_health_status }}</span>
                                </div>
                            </div>

                            {{-- Información de Contacto --}}
                            <div class="border-t pt-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-700">Contacto del Tutor:</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $donor->tutor_name }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <a href="tel:{{ $donor->tutor_phone }}" 
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            {{ $donor->tutor_phone }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Botones de Acción --}}
                            <div class="mt-4 flex space-x-2">
                                <button onclick="openDonorModal({{ $donor->id }})" 
                                       class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                                    Ver Detalles
                                </button>
                                <a href="tel:{{ $donor->tutor_phone }}" 
                                   class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-md hover:bg-green-700 transition-colors text-sm font-medium">
                                    Llamar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            <div class="mt-8">
                {{ $donors->links() }}
            </div>
        @else
            {{-- Estado Vacío --}}
            <div class="text-center py-12">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.462-.859-6.112-2.287l-.688-.688C5.45 11.645 6 11.199 6 10.5V9c0-.552-.448-1-1-1s-1 .448-1 1v1.5c0 1.54.76 2.887 1.89 3.722L6 14.314V16.5c0 .552.448 1 1 1s1-.448 1-1v-2.186l.11-.11C9.24 14.76 10.587 15 12 15s2.76-.24 3.89-.796l.11.11V16.5c0 .552.448 1 1 1s1-.448 1-1v-2.186l.11-.111C19.24 13.887 20 12.54 20 11V9.5c0-.552-.448-1-1-1s-1 .448-1 1v1c0 .699.55 1.145.8 1.525l-.688.688A7.962 7.962 0 0112 15z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">No hay donantes disponibles</h3>
                <p class="mt-2 text-gray-600">
                    Aún no hay mascotas registradas como donantes de sangre o están pendientes de aprobación.
                </p>
                <div class="mt-6">
                    <a href="{{ route('blood-donors.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Registrar la primera mascota donante
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Modal de Detalle del Donante --}}
<div id="donorModal" class="fixed inset-0 z-50 hidden">
    <!-- Fondo borroso -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" onclick="closeDonorModal()"></div>
    
    <!-- Contenido del modal -->
    <div class="fixed inset-0 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            {{-- Header del Modal --}}
            <div class="relative">
                <div id="modalHeader" class="h-32 sm:h-48 bg-gradient-to-r from-blue-500 to-purple-600 relative">
                    {{-- Botón de cerrar --}}
                    <button onclick="closeDonorModal()" 
                            class="absolute top-2 right-2 sm:top-4 sm:right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-2 transition-colors z-10">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    {{-- Badge de disponible --}}
                    <div class="absolute top-2 left-2 sm:top-4 sm:left-4">
                        <span class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                            ✅ Disponible para Donación
                        </span>
                    </div>
                    
                    {{-- Foto del animal --}}
                    <div id="modalPhoto" class="absolute -bottom-8 left-4 sm:-bottom-16 sm:left-8">
                        <div class="w-16 h-16 sm:w-32 sm:h-32 rounded-xl border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center overflow-hidden cursor-pointer hover:shadow-xl transition-shadow" onclick="openPhotoModal()">
                            <svg class="w-8 h-8 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contenido del Modal --}}
            <div class="p-4 sm:p-6 lg:p-8 pt-12 sm:pt-20 max-h-[calc(90vh-8rem)] overflow-y-auto">
                {{-- Información Principal --}}
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-6 sm:mb-8">
                    <div class="flex-1 mb-4 lg:mb-0">
                        <h2 id="modalAnimalName" class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Cargando...</h2>
                        <div id="modalBasicInfo" class="flex flex-wrap items-center gap-2 sm:gap-3 text-sm sm:text-lg text-gray-600 mb-4">
                            <!-- Se llena dinámicamente -->
                        </div>
                    </div>

                    {{-- Botones de Contacto --}}
                    <div class="flex flex-col sm:flex-row lg:flex-col space-y-3 sm:space-y-0 sm:space-x-3 lg:space-x-0 lg:space-y-3 lg:ml-8 min-w-[200px]">
                        <a id="modalCallButton" href="#" 
                           class="inline-flex items-center justify-center px-4 sm:px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Llamar Ahora
                        </a>
                        <a id="modalEmailButton" href="#" 
                           class="inline-flex items-center justify-center px-4 sm:px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Enviar Email
                        </a>
                    </div>
                </div>

                {{-- Información Detallada en Grid --}}
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 sm:gap-8">
                    {{-- Información del Animal --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="text-xl sm:text-2xl mr-2">🐾</span>
                            Información del Animal
                        </h3>
                        <div id="modalAnimalInfo" class="space-y-3 sm:space-y-4">
                            <!-- Se llena dinámicamente -->
                        </div>
                    </div>

                    {{-- Información del Tutor --}}
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="text-xl sm:text-2xl mr-2">👤</span>
                            Información de Contacto
                        </h3>
                        <div id="modalTutorInfo" class="space-y-3 sm:space-y-4">
                            <!-- Se llena dinámicamente -->
                        </div>
                    </div>
                </div>

                {{-- Información Importante --}}
                <div class="mt-6 sm:mt-8 bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 rounded-r-xl p-4 sm:p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-base sm:text-lg font-medium text-yellow-800 mb-3">⚠️ Información Importante</h4>
                            <div class="text-yellow-700 space-y-2 text-xs sm:text-sm">
                                <p>• <strong>Emergencia médica:</strong> Siempre contacta primero a tu veterinario</p>
                                <p>• <strong>Compatibilidad:</strong> Tu veterinario debe verificar la compatibilidad sanguínea</p>
                                <p>• <strong>Procedimiento:</strong> La donación debe realizarse en instalaciones veterinarias</p>
                                <p>• <strong>Contacto:</strong> Contacta al tutor responsable para coordinar la donación</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botón de Contacto Final --}}
                <div class="mt-6 sm:mt-8 text-center">
                    <a id="modalFinalCallButton" href="#" 
                       class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all transform hover:scale-105 text-base sm:text-lg font-medium shadow-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        📞 Contactar al Tutor
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Foto Ampliada --}}
<div id="photoModal" class="fixed inset-0 z-60 hidden">
    <!-- Fondo borroso -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity duration-300" onclick="closePhotoModal()"></div>
    
    <!-- Contenido de la foto -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-[90vh] w-full h-full flex items-center justify-center">
            <!-- Botón de cerrar -->
            <button onclick="closePhotoModal()" 
                    class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-3 transition-colors z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Imagen ampliada -->
            <div id="photoModalContent" class="w-full h-full flex items-center justify-center">
                <img id="photoModalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
            </div>
        </div>
    </div>
</div>

<script>
// Datos de los donantes para el modal
const donorsData = {
    @foreach($donors as $donor)
    {{ $donor->id }}: {
        id: {{ $donor->id }},
        animal_name: "{{ $donor->animal_name }}",
        animal_species: "{{ $donor->animal_species }}",
        formatted_species: "{{ $donor->formatted_species }}",
        animal_breed: "{{ $donor->animal_breed }}",
        animal_age: {{ $donor->animal_age }},
        animal_weight: "{{ $donor->animal_weight }}",
        formatted_health_status: "{{ $donor->formatted_health_status }}",
        vaccinated: {{ $donor->vaccinated ? 'true' : 'false' }},
        missing_vaccine: "{{ $donor->missing_vaccine }}",
        previous_donation: {{ $donor->previous_donation ? 'true' : 'false' }},
        previous_donation_date: "{{ $donor->previous_donation_date ? $donor->previous_donation_date->format('d/m/Y') : '' }}",
        formatted_diseases: "{{ $donor->formatted_diseases }}",
        tutor_name: "{{ $donor->tutor_name }}",
        tutor_phone: "{{ $donor->tutor_phone }}",
        tutor_email: "{{ $donor->tutor_email }}",
        animal_photo_url: "{{ $donor->animal_photo_url }}",
        created_at: "{{ $donor->created_at->format('d/m/Y') }}"
    },
    @endforeach
};

let currentPhotoUrl = '';

function openDonorModal(donorId) {
    const donor = donorsData[donorId];
    if (!donor) return;

    // Guardar URL de la foto para el modal de imagen
    currentPhotoUrl = donor.animal_photo_url;

    // Actualizar foto
    const photoDiv = document.getElementById('modalPhoto');
    if (donor.animal_photo_url) {
        photoDiv.innerHTML = `<img src="${donor.animal_photo_url}" alt="Foto de ${donor.animal_name}" class="w-16 h-16 sm:w-32 sm:h-32 rounded-xl object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openPhotoModal()">`;
    } else {
        photoDiv.innerHTML = `
            <div class="w-16 h-16 sm:w-32 sm:h-32 rounded-xl border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center overflow-hidden">
                <svg class="w-8 h-8 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>`;
    }

    // Actualizar información principal
    document.getElementById('modalAnimalName').textContent = donor.animal_name;
    
    // Información básica
    const basicInfo = document.getElementById('modalBasicInfo');
    basicInfo.innerHTML = `
        <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium ${
            donor.animal_species === 'perro' ? 'bg-blue-100 text-blue-800' : 
            donor.animal_species === 'gato' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'
        }">${donor.formatted_species}</span>
        <span class="font-medium">${donor.animal_breed}</span>
        <span>${donor.animal_age} años</span>
        <span>${donor.animal_weight} kg</span>
    `;

    // Información del animal
    const animalInfo = document.getElementById('modalAnimalInfo');
    animalInfo.innerHTML = `
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-blue-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Estado de Salud:</span>
            <span class="text-green-600 font-medium text-sm sm:text-base">${donor.formatted_health_status}</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-blue-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Vacunación:</span>
            <span class="${donor.vaccinated ? 'text-green-600' : 'text-red-600'} font-medium text-sm sm:text-base">
                ${donor.vaccinated ? '✅ Al día' : '❌ Pendiente'}
                ${!donor.vaccinated && donor.missing_vaccine ? `<br><small class="text-gray-500 text-xs">(Falta: ${donor.missing_vaccine})</small>` : ''}
            </span>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-blue-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Donación Anterior:</span>
            <div class="text-right">
                <span class="text-sm sm:text-base">${donor.previous_donation ? '✅ Sí' : '❌ Primera vez'}</span>
                ${donor.previous_donation && donor.previous_donation_date ? `<br><small class="text-gray-500 text-xs">Última: ${donor.previous_donation_date}</small>` : ''}
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start py-2 sm:py-3">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Enfermedades:</span>
            <span class="text-right text-gray-800 text-sm sm:text-base">${donor.formatted_diseases}</span>
        </div>
    `;

    // Información del tutor
    const tutorInfo = document.getElementById('modalTutorInfo');
    tutorInfo.innerHTML = `
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-green-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Tutor Responsable:</span>
            <span class="font-medium text-gray-900 text-sm sm:text-base">${donor.tutor_name}</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-green-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Teléfono:</span>
            <a href="tel:${donor.tutor_phone}" class="text-blue-600 hover:text-blue-800 font-medium text-sm sm:text-base break-all">${donor.tutor_phone}</a>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3 border-b border-green-100">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Email:</span>
            <a href="mailto:${donor.tutor_email}" class="text-blue-600 hover:text-blue-800 font-medium text-sm sm:text-base break-all">${donor.tutor_email}</a>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 sm:py-3">
            <span class="font-medium text-gray-700 text-sm sm:text-base">Registrado:</span>
            <span class="text-gray-600 text-sm sm:text-base">${donor.created_at}</span>
        </div>
    `;

    // Actualizar botones de contacto
    const callButtons = [
        document.getElementById('modalCallButton'),
        document.getElementById('modalFinalCallButton')
    ];
    const emailButton = document.getElementById('modalEmailButton');

    callButtons.forEach(button => {
        button.href = `tel:${donor.tutor_phone}`;
    });
    
    emailButton.href = `mailto:${donor.tutor_email}?subject=Solicitud de donación de sangre - ${donor.animal_name}`;

    // Mostrar modal con animación
    const modal = document.getElementById('donorModal');
    const modalContent = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Trigger animation
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDonorModal() {
    const modal = document.getElementById('donorModal');
    const modalContent = document.getElementById('modalContent');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 300);
}

function openPhotoModal() {
    if (!currentPhotoUrl) return;
    
    const photoModal = document.getElementById('photoModal');
    const photoModalImage = document.getElementById('photoModalImage');
    
    photoModalImage.src = currentPhotoUrl;
    photoModalImage.alt = 'Foto ampliada de la mascota';
    
    photoModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
    const photoModal = document.getElementById('photoModal');
    photoModal.classList.add('hidden');
    document.body.style.overflow = 'hidden'; // Mantener overflow hidden porque el modal principal sigue abierto
}

// Cerrar modals al hacer clic fuera
document.getElementById('donorModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDonorModal();
    }
});

document.getElementById('photoModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotoModal();
    }
});

// Cerrar modals con Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const photoModal = document.getElementById('photoModal');
        const donorModal = document.getElementById('donorModal');
        
        if (!photoModal.classList.contains('hidden')) {
            closePhotoModal();
        } else if (!donorModal.classList.contains('hidden')) {
            closeDonorModal();
        }
    }
});

// Prevenir el scroll del body cuando el modal está abierto
document.addEventListener('DOMContentLoaded', function() {
    // Asegurar que los modals estén ocultos al cargar
    document.getElementById('donorModal')?.classList.add('hidden');
    document.getElementById('photoModal')?.classList.add('hidden');
});
</script>

<style>
/* Mejoras adicionales para la animación y responsividad */
#modalContent {
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
}

/* Asegurar que las imágenes se vean bien en todos los tamaños */
@media (max-width: 640px) {
    #modalContent {
        margin: 1rem;
        max-height: calc(100vh - 2rem);
    }
    
    #modalHeader {
        height: 8rem;
    }
    
    #modalPhoto {
        bottom: -2rem;
        left: 1rem;
    }
}

/* Mejorar la visualización de la información en pantallas pequeñas */
@media (max-width: 640px) {
    .grid.xl\\:grid-cols-2 {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Efectos hover mejorados */
.hover\\:scale-105:hover {
    transform: scale(1.05);
}

/* Backdrop blur fallback */
.backdrop-blur-sm {
    backdrop-filter: blur(4px);
}

@supports not (backdrop-filter: blur(4px)) {
    .backdrop-blur-sm {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

/* Animación suave para los botones */
button, a[class*="bg-"] {
    transition: all 0.2s ease-in-out;
}

/* Mejorar la legibilidad en dispositivos móviles */
@media (max-width: 640px) {
    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }
    
    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
}
</style>
@endsection