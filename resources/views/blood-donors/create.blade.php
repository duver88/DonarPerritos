{{-- resources/views/blood-donors/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Registro de Donante de Sangre')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                🩸 Registro de Donante de Sangre 🐾
            </h1>
            <p class="text-lg text-gray-600">
                Ayuda a salvar vidas registrando a tu mascota como donante de sangre
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Por favor, corrija los siguientes errores:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('blood-donors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Datos del Tutor --}}
                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        👤 Datos del Tutor Responsable
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tutor_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre completo del tutor *
                            </label>
                            <input type="text" name="tutor_name" id="tutor_name" 
                                   value="{{ old('tutor_name') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="tutor_email" class="block text-sm font-medium text-gray-700 mb-2">
                                Correo Electrónico *
                            </label>
                            <input type="email" name="tutor_email" id="tutor_email" 
                                   value="{{ old('tutor_email') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="tutor_document" class="block text-sm font-medium text-gray-700 mb-2">
                                Número de Documento de Identidad *
                            </label>
                            <input type="text" name="tutor_document" id="tutor_document" 
                                   value="{{ old('tutor_document') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="tutor_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Teléfono de Contacto *
                            </label>
                            <input type="tel" name="tutor_phone" id="tutor_phone" 
                                   value="{{ old('tutor_phone') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Datos del Animal --}}
                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        🐕 Datos del Animal de Compañía
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="animal_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Animal *
                            </label>
                            <input type="text" name="animal_name" id="animal_name" 
                                   value="{{ old('animal_name') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="animal_breed" class="block text-sm font-medium text-gray-700 mb-2">
                                Raza *
                            </label>
                            <input type="text" name="animal_breed" id="animal_breed" 
                                   value="{{ old('animal_breed') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="animal_species" class="block text-sm font-medium text-gray-700 mb-2">
                                Especie *
                            </label>
                            <select name="animal_species" id="animal_species" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-Seleccione-</option>
                                <option value="perro" {{ old('animal_species') == 'perro' ? 'selected' : '' }}>Perro</option>
                                <option value="gato" {{ old('animal_species') == 'gato' ? 'selected' : '' }}>Gato</option>
                                <option value="otro" {{ old('animal_species') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div id="other_species_div" class="hidden">
                            <label for="animal_species_other" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar otra especie *
                            </label>
                            <input type="text" name="animal_species_other" id="animal_species_other" 
                                   value="{{ old('animal_species_other') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="animal_age" class="block text-sm font-medium text-gray-700 mb-2">
                                Edad del Animal (en años) *
                            </label>
                            <input type="number" name="animal_age" id="animal_age" 
                                   value="{{ old('animal_age') }}" required min="1" max="30"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="animal_weight" class="block text-sm font-medium text-gray-700 mb-2">
                                Peso del Animal (kg) *
                            </label>
                            <input type="number" name="animal_weight" id="animal_weight" 
                                   value="{{ old('animal_weight') }}" required min="0.1" max="100" step="0.1"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="md:col-span-2">
                            <label for="health_status" class="block text-sm font-medium text-gray-700 mb-2">
                                Estado de Salud Actual del Animal *
                            </label>
                            <select name="health_status" id="health_status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-Seleccione-</option>
                                <option value="excelente" {{ old('health_status') == 'excelente' ? 'selected' : '' }}>Excelente</option>
                                <option value="bueno" {{ old('health_status') == 'bueno' ? 'selected' : '' }}>Bueno</option>
                                <option value="requiere_tratamiento" {{ old('health_status') == 'requiere_tratamiento' ? 'selected' : '' }}>Requiere tratamiento</option>
                            </select>
                        </div>

                        <div id="health_treatment_div" class="md:col-span-2 hidden">
                            <label for="health_status_detail" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar tratamiento requerido *
                            </label>
                            <textarea name="health_status_detail" id="health_status_detail" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('health_status_detail') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Vacunas y Donaciones Previas --}}
                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        💉 Vacunas y Donaciones Previas
                    </h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿Está al día con las vacunas del animal? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="vaccinated" value="1" 
                                           {{ old('vaccinated') == '1' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="vaccinated" value="0" 
                                           {{ old('vaccinated') == '0' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                        <div id="missing_vaccine_div" class="hidden">
                            <label for="missing_vaccine" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar cuál vacuna falta *
                            </label>
                            <input type="text" name="missing_vaccine" id="missing_vaccine" 
                                   value="{{ old('missing_vaccine') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿El animal ha donado sangre anteriormente? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="previous_donation" value="0" 
                                           {{ old('previous_donation') == '0' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>No</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="previous_donation" value="1" 
                                           {{ old('previous_donation') == '1' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>Sí</span>
                                </label>
                            </div>
                        </div>

                        <div id="previous_donation_date_div" class="hidden">
                            <label for="previous_donation_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de la donación anterior *
                            </label>
                            <input type="date" name="previous_donation_date" id="previous_donation_date" 
                                   value="{{ old('previous_donation_date') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Condiciones de Salud --}}
                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        🏥 Condiciones de Salud del Animal
                    </h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿Tu animal tiene alguna enfermedad diagnosticada por un veterinario? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="has_diagnosed_disease" value="1" 
                                           {{ old('has_diagnosed_disease') == '1' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_diagnosed_disease" value="0" 
                                           {{ old('has_diagnosed_disease') == '0' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                        <div id="diagnosed_disease_div" class="hidden">
                            <label for="diagnosed_disease_detail" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar enfermedad diagnosticada *
                            </label>
                            <textarea name="diagnosed_disease_detail" id="diagnosed_disease_detail" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('diagnosed_disease_detail') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿Tu animal está bajo tratamiento médico actualmente? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="under_treatment" value="1" 
                                           {{ old('under_treatment') == '1' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="under_treatment" value="0" 
                                           {{ old('under_treatment') == '0' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                        <div id="treatment_div" class="hidden">
                            <label for="treatment_detail" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar tratamiento actual *
                            </label>
                            <textarea name="treatment_detail" id="treatment_detail" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('treatment_detail') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿Tu animal ha tenido alguna cirugía reciente? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="recent_surgery" value="1" 
                                           {{ old('recent_surgery') == '1' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="recent_surgery" value="0" 
                                           {{ old('recent_surgery') == '0' ? 'checked' : '' }}
                                           class="mr-2 text-blue-600">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                        <div id="surgery_div" class="hidden">
                            <label for="surgery_detail" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar cirugía reciente *
                            </label>
                            <textarea name="surgery_detail" id="surgery_detail" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('surgery_detail') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                ¿Tu animal ha sido diagnosticado con alguna de las siguientes enfermedades? *
                                <span class="text-sm text-gray-500">(marca todas las que apliquen)</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @php
                                    $diseases = [
                                        'leishmaniasis' => 'Leishmaniasis',
                                        'ehrlichiosis' => 'Ehrlichiosis',
                                        'parvovirus' => 'Parvovirus',
                                        'anemia' => 'Anemia',
                                        'hepatitis' => 'Hepatitis',
                                        'cancer' => 'Cáncer',
                                        'otros' => 'Otros'
                                    ];
                                @endphp
                                @foreach($diseases as $key => $label)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="diseases[]" value="{{ $key }}" 
                                               {{ in_array($key, old('diseases', [])) ? 'checked' : '' }}
                                               class="mr-2 text-blue-600">
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div id="other_diseases_div" class="hidden">
                            <label for="other_diseases" class="block text-sm font-medium text-gray-700 mb-2">
                                Especificar otras enfermedades *
                            </label>
                            <textarea name="other_diseases" id="other_diseases" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('other_diseases') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Foto del Animal --}}
                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                        📸 Foto del Animal
                    </h2>
                    
                    <div>
                        <label for="animal_photo" class="block text-sm font-medium text-gray-700 mb-2">
                            Subir foto reciente del animal *
                            <span class="text-sm text-gray-500">(jpg, png - máximo 2MB)</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="animal_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Seleccionar archivo</span>
                                        <input id="animal_photo" name="animal_photo" type="file" accept="image/*" required class="sr-only">
                                    </label>
                                    <p class="pl-1">o arrastra y suelta aquí</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG hasta 2MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('blood-donors.index') }}" 
                       class="px-6 py-3 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Enviar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar/ocultar campo de otra especie
    const speciesSelect = document.getElementById('animal_species');
    const otherSpeciesDiv = document.getElementById('other_species_div');
    
    speciesSelect.addEventListener('change', function() {
        if (this.value === 'otro') {
            otherSpeciesDiv.classList.remove('hidden');
            document.getElementById('animal_species_other').required = true;
        } else {
            otherSpeciesDiv.classList.add('hidden');
            document.getElementById('animal_species_other').required = false;
        }
    });

    // Mostrar/ocultar campo de tratamiento
    const healthStatusSelect = document.getElementById('health_status');
    const treatmentDiv = document.getElementById('health_treatment_div');
    
    healthStatusSelect.addEventListener('change', function() {
        if (this.value === 'requiere_tratamiento') {
            treatmentDiv.classList.remove('hidden');
            document.getElementById('health_status_detail').required = true;
        } else {
            treatmentDiv.classList.add('hidden');
            document.getElementById('health_status_detail').required = false;
        }
    });

    // Mostrar/ocultar campo de vacuna faltante
    const vaccinatedRadios = document.querySelectorAll('input[name="vaccinated"]');
    const missingVaccineDiv = document.getElementById('missing_vaccine_div');
    
    vaccinatedRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '0') {
                missingVaccineDiv.classList.remove('hidden');
                document.getElementById('missing_vaccine').required = true;
            } else {
                missingVaccineDiv.classList.add('hidden');
                document.getElementById('missing_vaccine').required = false;
            }
        });
    });

    // Mostrar/ocultar campo de fecha de donación anterior
    const previousDonationRadios = document.querySelectorAll('input[name="previous_donation"]');
    const previousDateDiv = document.getElementById('previous_donation_date_div');
    
    previousDonationRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                previousDateDiv.classList.remove('hidden');
                document.getElementById('previous_donation_date').required = true;
            } else {
                previousDateDiv.classList.add('hidden');
                document.getElementById('previous_donation_date').required = false;
            }
        });
    });

    // Mostrar/ocultar campos de condiciones de salud
    const diseaseRadios = document.querySelectorAll('input[name="has_diagnosed_disease"]');
    const diagnosedDiseaseDiv = document.getElementById('diagnosed_disease_div');
    
    diseaseRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                diagnosedDiseaseDiv.classList.remove('hidden');
                document.getElementById('diagnosed_disease_detail').required = true;
            } else {
                diagnosedDiseaseDiv.classList.add('hidden');
                document.getElementById('diagnosed_disease_detail').required = false;
            }
        });
    });

    const treatmentRadios = document.querySelectorAll('input[name="under_treatment"]');
    const treatmentDetailDiv = document.getElementById('treatment_div');
    
    treatmentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                treatmentDetailDiv.classList.remove('hidden');
                document.getElementById('treatment_detail').required = true;
            } else {
                treatmentDetailDiv.classList.add('hidden');
                document.getElementById('treatment_detail').required = false;
            }
        });
    });

    const surgeryRadios = document.querySelectorAll('input[name="recent_surgery"]');
    const surgeryDiv = document.getElementById('surgery_div');
    
    surgeryRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                surgeryDiv.classList.remove('hidden');
                document.getElementById('surgery_detail').required = true;
            } else {
                surgeryDiv.classList.add('hidden');
                document.getElementById('surgery_detail').required = false;
            }
        });
    });

    // Mostrar/ocultar campo de otras enfermedades
    const diseasesCheckboxes = document.querySelectorAll('input[name="diseases[]"]');
    const otherDiseasesDiv = document.getElementById('other_diseases_div');
    
    diseasesCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const otrosChecked = document.querySelector('input[name="diseases[]"][value="otros"]').checked;
            if (otrosChecked) {
                otherDiseasesDiv.classList.remove('hidden');
                document.getElementById('other_diseases').required = true;
            } else {
                otherDiseasesDiv.classList.add('hidden');
                document.getElementById('other_diseases').required = false;
            }
        });
    });

    // Inicializar campos al cargar la página
    if (speciesSelect.value === 'otro') {
        otherSpeciesDiv.classList.remove('hidden');
    }
    if (healthStatusSelect.value === 'requiere_tratamiento') {
        treatmentDiv.classList.remove('hidden');
    }
    // ... otros inicializadores según sea necesario
});
</script>
@endsection