@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Historiales Médicos</h1>
        <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Nuevo Historial
        </button>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Total Historiales</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['serviceCount'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Activos</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['activeServices'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Hoy</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['todayServices'] }}</p>
        </div>
    </div>

    <!-- Tabla de Historiales -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Paciente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Médico</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($services as $service)
                    
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                            {{ $service->patient->person->name_1 ?? 'N/A' }}
                            {{ $service->patient->person->surname_1 ?? '' }}
                            <br>
                            <small class="text-gray-500 dark:text-gray-400">
                                {{ $service->patient->person->identification ?? 'Sin identificación' }}
                            </small>
                        </td>
                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                            {{ $service->doctor->person->name_1 ?? 'N/A' }}
                            {{ $service->doctor->person->surname_1 ?? '' }}
                            <br>
                            <small class="text-gray-500 dark:text-gray-400">
                                {{ $service->doctor->speciality->name ?? 'No especificada' }}
                            </small>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($service->date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $service->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                   ($service->status == 'inactive' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                   'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                {{ ucfirst($service->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <button data-modal-target="show-modal-{{ $service->id }}" data-modal-toggle="show-modal-{{ $service->id }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button data-modal-target="edit-modal-{{ $service->id }}" data-modal-toggle="edit-modal-{{ $service->id }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No se encontraron historiales médicos</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            {{ $services->links() }}
        </div>
    </div>
</div>

<!-- Inclusión de Modales -->
@include('service.history.create_modal')

@foreach($services as $service)
    @include('service.history.show_modal', ['medicalHistory' => $service])
    @include('service.history.edit_modal', ['medicalHistory' => $service])
@endforeach

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Mostrar especialidad del médico seleccionado
    $('.doctor-select').change(function() {
        const especialidad = $(this).find(':selected').data('speciality');
        const displayDiv = $('#doctor-speciality-display');
        
        if (especialidad) {
            $('#selected-speciality').text(especialidad);
            displayDiv.removeClass('hidden');
        } else {
            displayDiv.addClass('hidden');
        }
    });
    
    // Inicializar select2
    $('.select2').select2({
        theme: 'classic',
        width: '100%'
    });
});
</script>
@endpush