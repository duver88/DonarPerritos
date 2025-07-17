{{-- resources/views/blood-donors/success.blade.php --}}
@extends('layouts.app')

@section('title', 'Registro Exitoso - Donante de Sangre')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100 flex items-center justify-center py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8 text-center">
            {{-- Icono de éxito --}}
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            {{-- Título --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                ¡Registro Exitoso! 🎉
            </h1>

            {{-- Mensaje principal --}}
            <div class="mb-8">
                <p class="text-lg text-gray-600 mb-4">
                    Tu mascota ha sido registrada como donante de sangre exitosamente.
                </p>
                <p class="text-gray-600">
                    Nuestro equipo revisará la información proporcionada y se pondrá en contacto contigo 
                    si es necesario aclarar algún detalle.
                </p>
            </div>

            {{-- Información del proceso --}}
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8 text-left">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            ¿Qué sigue ahora?
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Nuestro equipo veterinario revisará la información de tu mascota</li>
                                <li>Te contactaremos en caso de necesitar información adicional</li>
                                <li>Una vez aprobado, tu mascota aparecerá en la lista de donantes disponibles</li>
                                <li>Recibirás contactos de personas que necesiten donantes compatibles</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tiempo estimado --}}
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 text-left">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            Tiempo de Revisión
                        </h3>
                        <p class="mt-2 text-sm text-yellow-700">
                            El proceso de revisión toma normalmente entre <strong>24 a 72 horas</strong>. 
                            Te notificaremos por correo electrónico sobre el estado de tu solicitud.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('blood-donors.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Ver Donantes Disponibles
                </a>
                
                <a href="{{ route('blood-donors.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Registrar Otra Mascota
                </a>
            </div>

            {{-- Información de contacto --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    ¿Tienes preguntas? Contáctanos en 
                    <a href="mailto:info@donasangre.com" class="text-blue-600 hover:text-blue-800">
                        info@donasangre.com
                    </a>
                </p>
            </div>
        </div>

        {{-- Información adicional --}}
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 text-center">
                💡 Mientras Esperas la Aprobación
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Mantén a tu mascota saludable</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Asegúrate de que esté al día con las vacunas</li>
                        <li>• Mantén una dieta balanceada</li>
                        <li>• Ejercicio regular según su edad y raza</li>
                        <li>• Visitas veterinarias de rutina</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Prepárate para ayudar</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Ten tu teléfono disponible para emergencias</li>
                        <li>• Conoce la ubicación de clínicas veterinarias cercanas</li>
                        <li>• Mantén actualizada tu información de contacto</li>
                        <li>• Comparte esta plataforma con otros dueños</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection