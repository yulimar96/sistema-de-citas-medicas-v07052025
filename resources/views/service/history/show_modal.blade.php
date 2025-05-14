<div id="show-modal-{{ $medicalHistory->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detalles del Historial Médico
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="show-modal-{{ $medicalHistory->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <div class="p-4 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Información Básica</h4>
                        <div class="mt-4 space-y-2">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Paciente</p>
                                <p class="text-gray-800 dark:text-white">{{ $medicalHistory->patient->person->full_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Médico</p>
                                <p class="text-gray-800 dark:text-white">{{ $medicalHistory->doctor->person->full_name ?? 'No asignado' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Fecha</p>
                                <p class="text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($medicalHistory->date)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Estado</p>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $medicalHistory->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                       ($medicalHistory->status == 'inactive' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                       'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                    {{ ucfirst($medicalHistory->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Información Médica</h4>
                        <div class="mt-4 space-y-2">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Diagnóstico</p>
                                <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $medicalHistory->diagnosis ?? 'No registrado' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tratamiento</p>
                                <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $medicalHistory->treatment ?? 'No registrado' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="show-modal-{{ $medicalHistory->id }}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>