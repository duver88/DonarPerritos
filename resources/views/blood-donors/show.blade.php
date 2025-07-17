@extends('layouts.app')

@section('title', 'Detalle de ' . $donor->animal_name . ' - Donante de Sangre')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Navegación --}}
        <div class="mb-6">
            <a href="{{ route('blood-donors.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a Donantes Disponibles
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            {{-- Header con foto --}}
            <div class="relative">
                <div class="h-64 bg-gradient-to-r from-blue-500 to-purple-600">
                    @if($donor->animal_photo_url)
                        <img src="{{ $donor->animal_photo_url }}" 
                             alt="Foto de {{ $donor->animal_name }}"
                             class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                {{-- Badge de estado --}}
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        ✅ Disponible para Donación
                    </span>
                </div>
            </div>

            {{-- Información Principal --}}
            <div class="p-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-8">
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $donor->animal_name }}</h1>
                        <div class="flex items-center space-x-4 text-lg text-gray-600 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $donor->animal_species == 'perro' ? 'bg-blue-100 text-blue-800' : 
                                   ($donor->animal_species == 'gato' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $donor->formatted_species }}
                            </span>
                            <span>{{ $donor->animal_breed }}</span>
                            <span>{{ $donor->animal_age }} años</span>
                            <span>{{ $donor->animal_weight }} kg</span>
                        </div>
                    </div>

                    {{-- Botones de Contacto --}}
                    <div class="flex flex-col space-y-3 lg:ml-8">
                        <a href="tel:{{ $donor->tutor_phone }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-lg font-medium">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Llamar Ahora
                        </a>
                        <a href="mailto:{{ $donor->tutor_email }}?subject=Solicitud de donación de sangre - {{ $donor->animal_name }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg font-medium">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Enviar Email
                        </a>
                    </div>
                </div>

                {{-- Información Detallada --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Información del Animal --}}
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="text-2xl mr-2">🐾</span>
                            Información del Animal
                        </h2>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Estado de Salud:</span>
                                <span class="text-green-600 font-medium">{{ $donor->formatted_health_status }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Vacunación:</span>
                                <span class="{{ $donor->vaccinated ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $donor->vaccinated ? '✅ Al día' : '❌ Pendiente' }}
                                    @if(!$donor->vaccinated && $donor->missing_vaccine)
                                        <br><small class="text-gray-500">(Falta: {{ $donor->missing_vaccine }})</small>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Donación Anterior:</span>
                                <span>
                                    {{ $donor->previous_donation ? '✅ Sí' : '❌ Primera vez' }}
                                    @if($donor->previous_donation && $donor->previous_donation_date)
                                        <br><small class="text-gray-500">Última: {{ $donor->previous_donation_date->format('d/m/Y') }}</small>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Enfermedades:</span>
                                <span class="text-right">{{ $donor->formatted_diseases }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Información del Tutor --}}
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="text-2xl mr-2">👤</span>
                            Información de Contacto
                        </h2>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Tutor Responsable:</span>
                                <span class="font-medium">{{ $donor->tutor_name }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Teléfono:</span>
                                <a href="tel:{{ $donor->tutor_phone }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $donor->tutor_phone }}
                                </a>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Email:</span>
                                <a href="mailto:{{ $donor->tutor_email }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium break-all">
                                    {{ $donor->tutor_email }}
                                </a>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Registrado:</span>
                                <span class="text-gray-600">{{ $donor->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información Importante --}}
                <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-400 p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-yellow-800 mb-2">⚠️ Información Importante</h3>
                            <div class="text-yellow-700 space-y-2">
                                <p>• <strong>Emergencia médica:</strong> Siempre contacta primero a tu veterinario</p>
                                <p>• <strong>Compatibilidad:</strong> Tu veterinario debe verificar la compatibilidad sanguínea</p>
                                <p>• <strong>Procedimiento:</strong> La donación debe realizarse en instalaciones veterinarias</p>
                                <p>• <strong>Contacto:</strong> Contacta al tutor responsable para coordinar la donación</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción Finales --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:{{ $donor->tutor_phone }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-lg font-medium">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        📞 Contactar al Tutor: {{ $donor->tutor_phone }}
                    </a>
                    
                    <a href="{{ route('blood-donors.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg font-medium">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        🔍 Ver Otros Donantes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection