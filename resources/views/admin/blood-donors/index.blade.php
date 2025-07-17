@extends('layouts.app')

@section('title', 'Panel de Administración - Donantes de Sangre')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Panel de Administración</h1>
            <p class="text-gray-600">Gestiona las solicitudes de donantes de sangre para mascotas</p>
        </div>

        {{-- Estadísticas CLICKEABLES --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {{-- Total - Muestra TODOS --}}
            <a href="{{ route('admin.blood-donors.index') }}" 
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow {{ !request('status') ? 'ring-2 ring-blue-500' : '' }}">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
                        <p class="text-xs text-blue-600 mt-1">👆 Click para ver todos</p>
                    </div>
                </div>
            </a>

            {{-- Pendientes - Muestra SOLO PENDIENTES --}}
            <a href="{{ route('admin.blood-donors.index', ['status' => 'pendiente']) }}" 
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow {{ request('status') == 'pendiente' ? 'ring-2 ring-yellow-500' : '' }}">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pendientes</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</p>
                        <p class="text-xs text-yellow-600 mt-1">👆 Click para revisar</p>
                    </div>
                </div>
            </a>

            {{-- Aprobados - Muestra SOLO APROBADOS --}}
            <a href="{{ route('admin.blood-donors.index', ['status' => 'aprobado']) }}" 
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow {{ request('status') == 'aprobado' ? 'ring-2 ring-green-500' : '' }}">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Aprobados</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved'] }}</p>
                        <p class="text-xs text-green-600 mt-1">👆 Click para ver publicados</p>
                    </div>
                </div>
            </a>

            {{-- Rechazados - Muestra SOLO RECHAZADOS --}}
            <a href="{{ route('admin.blood-donors.index', ['status' => 'rechazado']) }}" 
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow {{ request('status') == 'rechazado' ? 'ring-2 ring-red-500' : '' }}">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rechazados</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['rejected'] }}</p>
                        <p class="text-xs text-red-600 mt-1">👆 Click para ver rechazados</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Indicador de filtro activo --}}
        @if(request('status'))
            <div class="mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                            </svg>
                            <span class="text-blue-800 font-medium">
                                📋 Mostrando solo: 
                                <span class="capitalize">{{ request('status') }}</span>
                                ({{ $donors->total() }} {{ $donors->total() == 1 ? 'registro' : 'registros' }})
                            </span>
                        </div>
                        <a href="{{ route('admin.blood-donors.index') }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            ✖️ Quitar filtro
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- DEBUG --}}
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
            <p><strong>🔍 Debug:</strong></p>
            <p>Total de donantes: {{ $donors->total() }}</p>
            <p>Count de donantes: {{ $donors->count() }}</p>
            <p>¿Hay donantes? {{ $donors->count() > 0 ? 'SÍ' : 'NO' }}</p>
        </div>

        {{-- Lista de Donantes --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Solicitudes de Donantes ({{ $donors->count() }})</h3>
            </div>

            @if($donors->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($donors as $donor)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900">
                                            🐕 {{ $donor->animal_name ?? 'Sin nombre' }}
                                        </h4>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            {{ $donor->status == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($donor->status == 'aprobado' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($donor->status ?? 'Sin estado') }}
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                        <div>
                                            <span class="font-medium">👤 Tutor:</span> {{ $donor->tutor_name ?? 'Sin nombre' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">📧 Email:</span> {{ $donor->tutor_email ?? 'Sin email' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">📱 Teléfono:</span> {{ $donor->tutor_phone ?? 'Sin teléfono' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">🐾 Especie:</span> {{ $donor->animal_species ?? 'Sin especie' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">🏷️ Raza:</span> {{ $donor->animal_breed ?? 'Sin raza' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">📅 Registrado:</span> {{ $donor->created_at ? $donor->created_at->format('d/m/Y H:i') : 'Sin fecha' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Acciones --}}
                                <div class="flex flex-col space-y-2 ml-4">
                                    @if($donor->status == 'pendiente')
                                        {{-- Acciones para PENDIENTES --}}
                                        <form action="{{ route('admin.blood-donors.approve', $donor) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 transition-colors w-full"
                                                    onclick="return confirm('¿Aprobar este donante?')">
                                                ✅ Aprobar
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.blood-donors.reject', $donor) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="admin_notes" value="Rechazado desde panel rápido">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition-colors w-full"
                                                    onclick="return confirm('¿Rechazar este donante?')">
                                                ❌ Rechazar
                                            </button>
                                        </form>
                                    @else
                                        {{-- Indicador de estado actual --}}
                                        <div class="text-center mb-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                {{ $donor->status == 'aprobado' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $donor->status == 'aprobado' ? '✅ Aprobado' : '❌ Rechazado' }}
                                            </span>
                                        </div>
                                        
                                        {{-- Botón para cambiar estado --}}
                                        <button onclick="showChangeStatusModal({{ $donor->id }}, '{{ $donor->status }}', '{{ $donor->animal_name }}')" 
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors w-full">
                                            🔄 Cambiar Estado
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <h3 class="mt-4 text-xl font-medium text-gray-900">No hay solicitudes</h3>
                    <p class="mt-2 text-gray-600">Los registros aparecerán aquí cuando se registren donantes.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal para Cambiar Estado --}}
<div id="changeStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="changeStatusForm" method="POST">
            @csrf
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">🔄 Cambiar Estado del Donante</h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-gray-600 mb-2">
                        <strong>Animal:</strong> <span id="modalAnimalName"></span>
                    </p>
                    <p class="text-gray-600 mb-4">
                        <strong>Estado actual:</strong> 
                        <span id="modalCurrentStatus" class="font-medium"></span>
                    </p>
                </div>
                
                <div class="mb-4">
                    <label for="new_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Nuevo Estado *
                    </label>
                    <select name="new_status" id="new_status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccionar nuevo estado</option>
                        <option value="pendiente">⏰ Pendiente (por revisar)</option>
                        <option value="aprobado">✅ Aprobado (se publica en web)</option>
                        <option value="rechazado">❌ Rechazado (no se publica)</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="change_admin_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Razón del cambio (opcional)
                    </label>
                    <textarea name="admin_notes" id="change_admin_notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Explica por qué cambias el estado..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                <button type="button" onclick="hideChangeStatusModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    🔄 Cambiar Estado
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal para cambiar estado
function showChangeStatusModal(donorId, currentStatus, animalName) {
    const modal = document.getElementById('changeStatusModal');
    const form = document.getElementById('changeStatusForm');
    const animalNameSpan = document.getElementById('modalAnimalName');
    const currentStatusSpan = document.getElementById('modalCurrentStatus');
    const newStatusSelect = document.getElementById('new_status');
    
    // Configurar el formulario
    form.action = `/admin/donantes/${donorId}/cambiar-estado`;
    animalNameSpan.textContent = animalName;
    
    // Mostrar estado actual con formato bonito
    const statusNames = {
        'pendiente': '⏰ Pendiente',
        'aprobado': '✅ Aprobado',
        'rechazado': '❌ Rechazado'
    };
    currentStatusSpan.textContent = statusNames[currentStatus] || currentStatus;
    
    // Limpiar selección anterior
    newStatusSelect.value = '';
    document.getElementById('change_admin_notes').value = '';
    
    // Mostrar modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function hideChangeStatusModal() {
    const modal = document.getElementById('changeStatusModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Cerrar modal al hacer clic fuera
document.getElementById('changeStatusModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        hideChangeStatusModal();
    }
});

// Cerrar modal con Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideChangeStatusModal();
    }
});

// Validación del formulario
document.getElementById('changeStatusForm')?.addEventListener('submit', function(e) {
    const newStatus = document.getElementById('new_status').value;
    
    if (!newStatus) {
        e.preventDefault();
        alert('Por favor, selecciona un nuevo estado.');
        return;
    }
    
    const statusNames = {
        'pendiente': 'Pendiente',
        'aprobado': 'Aprobado',
        'rechazado': 'Rechazado'
    };
    
    if (!confirm(`¿Estás seguro de cambiar el estado a "${statusNames[newStatus]}"?`)) {
        e.preventDefault();
    }
});
</script>
@endsection