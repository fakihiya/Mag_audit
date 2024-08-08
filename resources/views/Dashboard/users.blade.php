@extends('layouts.app')
@section('content')
    <!-- Start block -->

    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="createuserModalButton" data-modal-target="createuserModal"
                            data-modal-toggle="createuserModal"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Ajouter utulisateur
                        </button>

                    </div>
                </div>
                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">Actions</th>
                                <th scope="col" class="px-4 py-4"> Nom</th>
                                <th scope="col" class="px-4 py-4"> Prenom</th>
                                <th scope="col" class="px-4 py-4">Email</th>
                                <th scope="col" class="px-4 py-4">Sexe</th>
                                <th scope="col" class="px-4 py-4">Age</th>
                                <th scope="col" class="px-4 py-4">Profession</th>
                                <th scope="col" class="px-4 py-4">EnCouple</th>
                                <th scope="col" class="px-4 py-4">TypeVisite</th>
                                <th scope="col" class="px-4 py-4">CanalReservation</th>
                                <th scope="col" class="px-4 py-4">Chambre</th>
                                <th scope="col" class="px-4 py-4">ReservationEffectuee</th>
                                <th scope="col" class="px-4 py-4">Role</th>
                                <th scope="col" class="px-4 py-3">
                                  Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button id="{{ $user->id }}-dropdown-button"
                                            data-dropdown-toggle="{{ $user->id }}-dropdown"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $user->id }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm" aria-labelledby="{{ $user->id }}-dropdown-button">
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="updateuserModal{{ $user->id }}"
                                                        data-modal-toggle="updateuserModal{{ $user->id }}"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                        Modifier
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="{{route('showmisson')}}" type="button" data-modal-target="readuserModal"
                                                        data-modal-toggle="readairportModal"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                        Voir Mission
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="deleteButton" data-modal-target="deleteModal"
                                                        data-modal-toggle="deleteModal" data-record-id="{{ $user->id }}"
                                                        data-action="{{ route('user.delete', $user->id) }}"
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                        supprimer
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
      
                                    <td class="px-4 py-3">{{ $user->Nom }}</td>
                                    <td class="px-4 py-3">{{ $user->Prenom }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">{{ $user->Sexe }}</td>
                                    <td class="px-4 py-3">{{ $user->Age }}</td>
                                    <td class="px-4 py-3">{{ $user->Profession }}</td>
                                    <td class="px-4 py-3">{{ $user->EnCouple }}</td>
                                    <td class="px-4 py-3">{{ $user->TypeVisite }}</td>
                                    <td class="px-4 py-3">{{ $user->CanalReservation }}</td>
                                    <td class="px-4 py-3">{{ $user->Chambre }}</td>
                                    <td class="px-4 py-3">{{ $user->ReservationEffectuee }}</td>
                                    <td class="px-4 py-3">{{ $user->role }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button id="{{ $user->Nom }}-dropdown-button"
                                            data-dropdown-toggle="{{ $user->Nom }}-dropdown"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $user->Nom }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm" aria-labelledby="{{ $user->Nom }}-dropdown-button">
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="updateuserModal{{ $user->id }}"
                                                        data-modal-toggle="updateuserModal{{ $user->id }}"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                        Modifier
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="{{route('showmisson')}}" type="button" data-modal-target="readuserModal"
                                                    data-modal-toggle="readairportModal"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                    Voir Mission
                                                </a>
                                                </li>
                                                <li>
                                          
                                                    <a id="deleteButton" data-modal-target="deleteModal"
                                                        data-modal-toggle="deleteModal" data-record-id="1"
                                                        data-record-id="{{ $user->id }}"
                                                        data-action="{{route('user.delete',$user->id)}}"
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">

                                                        supprimer
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                <!-- Update modal -->
                                <div id="updateuserModal{{ $user->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <!-- Modal header -->
                                            <div
                                                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Update user
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    onclick="closeModal('updateuserModal{{ $user->id }}')">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form action="{{route('user.update',$user->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <div>
                                                        <label for="Nom"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                        <input type="text" name="Nom" id="Nom"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Nom" value="{{ $user->Nom }}" required>
                                                    </div>
                                
                                                   <div>
                                                        <label for="Prenom"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                        <input type="text" name="Prenom" id="Prenom"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Prénom" value="{{ $user->Prenom }}" required>
                                                    </div>
                                 
                                                    <div>
                                                        <label for="email"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                        <input type="email" name="email" id="email"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Email" value="{{ $user->email }}" required>
                                                    </div>
                               
                                                    <div>
                                                        <label for="role"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">role</label>
                                                        <select name="role" id="role"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                                                            <option value="super admin" {{ $user->role == 'super admin' ? 'selected' : '' }}>super admin</option>
                                                        </select>
                                                    </div>
                                
                                                    <div>
                                                        <label for="Sexe"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                                                        <select name="Sexe" id="Sexe"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="Masculin" {{ $user->Sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                                            <option value="Féminin" {{ $user->Sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                                        </select>
                                                    </div>
                               
                                                    <div>
                                                        <label for="Age"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                                        <input type="number" name="Age" id="Age"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Age" value="{{ $user->Age }}" required>
                                                    </div>
                              
                                                    <div>
                                                        <label for="Profession"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profession</label>
                                                        <input type="text" name="Profession" id="Profession"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Profession" value="{{ $user->Profession }}" required>
                                                    </div>
                                   
                                                    <div>
                                                        <label for="EnCouple"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">En couple</label>
                                                        <select name="EnCouple" id="EnCouple"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="En couple" {{ $user->EnCouple == 'En couple' ? 'selected' : '' }}>En couple</option>
                                                            <option value="Seul" {{ $user->EnCouple == 'Seul' ? 'selected' : '' }}>Seul</option>
                                                        </select>
                                                    </div>
                              
                                                    <div>
                                                        <label for="Visite"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de visite</label>
                                                        <select name="TypeVisite" id="TypeVisite"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="Visite professionnelle" {{ $user->TypeVisite	 == 'Visite professionnelle' ? 'selected' : '' }}>Visite professionnelle</option>
                                                            <option value="Visite personnelle" {{ $user->TypeVisite	 == 'Visite personnelle' ? 'selected' : '' }}>Visite personnelle</option>
                                                        </select>
                                                    </div>
                                 
                                                    <div>
                                                        <label for="Chambre"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chambre</label>
                                                        <input type="text" name="Chambre" id="Chambre"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Chambre" value="{{ $user->Chambre }}" required>
                                                    </div>
                                 
                                                    <div>
                                                        <label for="ReservationEffectuee"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de réservation</label>
                                                        <input type="datetime-local" name="ReservationEffectuee" id="ReservationEffectuee"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            value="{{ \Carbon\Carbon::parse($user->ReservationEffectuee)->format('Y-m-d\TH:i') }}" required>
                                                    </div>
                                  
                                                    <div>
                                                        <label for="CanalReservation"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Canal de réservation</label>
                                                        <select name="CanalReservation" id="CanalReservation"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="site web" {{ $user->CanalReservation == 'site web' ? 'selected' : '' }}>Site web</option>
                                                            <option value="tél" {{ $user->CanalReservation == 'tél' ? 'selected' : '' }}>Téléphone</option>
                                                        </select>
                                                    </div>
                                
                                                </div>
                                
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Update user
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{-- <div>
                {{ $events->links() }}
            </div> --}}
            </div>
        </div>

    </section>


<!-- Create modal -->
<div id="createuserModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add user</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-target="createuserModal" data-modal-toggle="createuserModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('add_user') }}" method="POST">

                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="Nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="Nom" id="Nom"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Votre Nom" required>
                    </div>

                    <div>
                        <label for="Prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                        <input type="text" name="Prenom" id="Prenom"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Votre Prenom" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="saqyj@mailinator.com" required>
                    </div>

                    <div>
                        <label for="MotDePasse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">MotDePasse</label>
                        <input type="password" name="MotDePasse" id="MotDePasse"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="******************" required>
                    </div>

                    <div>
                        <label for="Sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                        <select name="Sexe" id="Sexe"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="Masculin">Masculin</option>
                            <option value="Féminin">Féminin</option>
                        </select>
                    </div>

                    <div>
                        <label for="Age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Âge</label>
                        <input type="number" name="Age" id="Age"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="36" required>
                    </div>

                    <div>
                        <label for="Profession" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profession</label>
                        <input type="text" name="Profession" id="Profession"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Responsable Achats secteur pharmaceutique" required>
                    </div>

                    <div>
                        <label for="EnCouple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">En couple ou seul</label>
                        <select name="EnCouple" id="EnCouple"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="En couple">En couple</option>
                            <option value="Seul">Seul</option>
                        </select>
                    </div>

                    <div>
                        <label for="TypeVisite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visite</label>
                        <select name="TypeVisite" id="TypeVisite"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="Visite professionnelle">Visite professionnelle</option>
                            <option value="Visite personnelle">Visite personnelle</option>
                        </select>
                    </div>

                    <div>
                        <label for="CanalReservation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Canal de réservation</label>
                        <select name="CanalReservation" id="CanalReservation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="site web">Site web</option>
                            <option value="tél">Téléphone</option>
                        </select>
                    </div>

                    <div>
                        <label for="Chambre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° de chambre</label>
                        <input type="number" name="Chambre" id="Chambre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="539" required>
                    </div>

                    <div>
                        <label for="ReservationEffectuee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Réservation effectuée le</label>
                        <input type="datetime-local" name="ReservationEffectuee" id="ReservationEffectuee"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>

                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select name="role" id="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="" disabled selected>Select role</option>
                            {{-- <option value="user">User</option> --}}
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add new user
                </button>
            </form>
        </div>
    </div>
</div>



    <!-- Read modal -->
    <div id="readuserModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold ">Apple iMac 27”</h3>
                        <p class="font-bold">$2999</p>
                    </div>
                    <div>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="readuserModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core
                        10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon
                        Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic
                        Keyboard - US.</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd>
                </dl>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <button type="button"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Edit
                        </button>
                        <button type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Preview</button>
                    </div>
                    <a id="deleteButton" data-modal-target="" data-modal-toggle="" data-record-id="1"
                        {{-- data-record-id="{{ $user->id }}"
                data-action="{{ route('users.delete', $user->id) }}" --}}
                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">

                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete modal -->

    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden backdrop-brightness-50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are
                    you sure you want to delete this item?</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="deleteModal" type="button"
                        class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="deleteRecordId">
                        <button type="submit"
                            class="delete-confirm-button py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection





<script>
    // delete functionality
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const deleteRecordIdInput = document.getElementById('deleteRecordId');
        const deleteConfirmButton = deleteModal.querySelector('.delete-confirm-button');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const recordId = button.getAttribute('data-record-id');
                const deleteAction = button.getAttribute('data-action');

                deleteForm.action = deleteAction;
                deleteRecordIdInput.value = recordId;

                deleteModal.classList.remove('hidden');
            });
        });

        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(deleteForm.action, {
                    method: 'POST',
                    body: new FormData(deleteForm),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log(data.message);

                        const successMessage = document.getElementById('successMessage');
                        if (successMessage) {
                            successMessage.innerText = data.message;
                        }

                        location.reload();
                    } else {
                        console.error(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error deleting record:', error.message);
                })
                .finally(() => {
                    deleteModal.classList.add('hidden');
                });
        });
    });
</script>

























































