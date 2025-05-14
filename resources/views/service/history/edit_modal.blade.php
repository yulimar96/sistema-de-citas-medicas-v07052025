<div id="edit-modal-{{ $medicalHistory->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Historial Médico
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-modal-{{ $medicalHistory->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <div class="p-4">
                <form action="{{ route('history.update', $medicalHistory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-4">
                                <label for="patient_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                                <select name="patient_id" id="patient_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white select2" required>
                                    <option value="">Seleccione un paciente</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient['id'] }}" {{ $medicalHistory->patient_id == $patient['id'] ? 'selected' : '' }}>
                                            {{ $patient['full_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="doctor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Médico</label>
                                <select name="doctor_id" id="doctor_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white select2">
                                    <option value="">Seleccione un médico</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}" {{ $medicalHistory->doctor_id == $doctor['id'] ? 'selected' : '' }}>
                                            {{ $doctor['full_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                                <input type="date" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($medicalHistory->date)->format('Y-m-d')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            
                            <div class="mb-4">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="active" {{ $medicalHistory->status == 'active' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactive" {{ $medicalHistory->status == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="suspended" {{ $medicalHistory->status == 'suspended' ? 'selected' : '' }}>Suspendido</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-4">
                                <label for="diagnosis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diagnóstico</label>
                                <textarea name="diagnosis" id="diagnosis" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ old('diagnosis', $medicalHistory->diagnosis) }}</textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="treatment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tratamiento</label>
                                <textarea name="treatment" id="treatment" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ old('treatment', $medicalHistory->treatment) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" data-modal-hide="edit-modal-{{ $medicalHistory->id }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>