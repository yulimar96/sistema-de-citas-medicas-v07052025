<!-- Modal para editar un usuario -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="editConceptoModalTitle" class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar un Paciente
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <form class="form_edit space-y-4" method="POST"
                    action="/patient/actualizar/{{ $patient->id }}">
                    @csrf <!-- Asegúrate de incluir el token CSRF si estás usando Laravel -->
                    @method('PATCH') <!-- Método para actualizar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Name') }}</label>
                            <input type="text" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value={{$patient->name}} required />
                        </div>
                        <div>
                            <label for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Last name') }}</label>
                            <input type="text" name="last_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                               value={{$patient->last_name}} required />
                        </div>
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Address') }}</label>
                            <input type="text" name="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value={{$patient->address}} required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Email') }}</label>
                            <input type="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value={{$patient->email}} />
                        </div>
                        <div>
                            <label for="birthdate"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Birthdate') }}</label>
                            <input type="date" name="birthdate" value={{$patient->birthdate}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <div>
                            <label for="nacionality"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Nacionality') }}</label>
                            <select name="nacionality" value={{$patient->nacionality}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option selected disabled>Selecciona...</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div>
                            <label for="identification_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Identification Number') }}</label>
                            <input type="text" name="identification_number" value={{$patient->identification_number}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Password') }}</label>
                            <input type="password" name="password" value={{$patient->password}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" value={{$patient->password_confirmation}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="code_area"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Code area') }}</label>
                            <select name="code_area" value={{$patient->code_area}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option selected disabled>Selecciona...</option>
                                <option value="0412">0412</option>
                                <option value="0414">0414</option>
                                <option value="0424">0424</option>
                                <option value="0416">0416</option>
                            </select>
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                {{ __('Phone') }}</label>
                            <input type="text" name="phone" value={{$patient->phone}}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800
                     focus:ring-4 focus:outline-none focus:ring-blue-300 
                     font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                     dark:bg-blue-600 dark:hover:bg-blue-700
                      dark:focus:ring-blue-800">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
