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
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 overflow-x-auto">

                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="createhotelModalButton" data-modal-target="createhotelModal "
                            data-modal-toggle="createhotelModal"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Ajouter hotel
                        </button>
                        <form class="flex flex-col sm:flex-row gap-1" action="{{ route('hotels.search') }}" method="post">
                            @csrf
                            <div class="flex-1">
                                <input id="searchByName" name="Nom" type="text" placeholder="Rechercher par Nom"
                                    value="{{ request('Nom') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                            </div>
                            <div class="flex-1 mt-2 sm:mt-0">
                                <select id="searchByVille" name="ville"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                    <option value="">Rechercher par ville</option>
                                    @foreach ($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ request('ville') == $ville->id ? 'selected' : '' }}>{{ $ville->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 mt-2 sm:mt-0">
                                <select id="categorySelect" name="categorie"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                    <option value="">Choisir une catégorie</option>
                                    <option value="etoile1" {{ request('categorie') == 'etoile1' ? 'selected' : '' }}>
                                        etoile1</option>
                                    <option value="etoile2" {{ request('categorie') == 'etoile2' ? 'selected' : '' }}>
                                        etoile2</option>
                                    <option value="etoile3" {{ request('categorie') == 'etoile3' ? 'selected' : '' }}>
                                        etoile3</option>
                                    <option value="etoile4" {{ request('categorie') == 'etoile4' ? 'selected' : '' }}>
                                        etoile4</option>
                                    <option value="etoile5" {{ request('categorie') == 'etoile5' ? 'selected' : '' }}>
                                        etoile5</option>
                                    <option value="Luxe" {{ request('categorie') == 'Luxe' ? 'selected' : '' }}>Luxe
                                    </option>
                                </select>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <button id="searchButton"
                                    class="w-full sm:w-auto px-6 py-2 bg-green-800 text-white rounded-md hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-purple-600">Recherche</button>
                            </div>
                        </form>

                        <div class="mt-2">
                            <a href="{{ route('hotels.index') }}">
                                <button
                                    class="w-full sm:w-auto px-6 py-2 bg-red-800 text-white rounded-md hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-purple-600">Reset</button>
                            </a>
                        </div>


                    </div>
                </div>
                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Actions</th>
                                <th scope="col" class="px-4 py-4">Logo</th>
                                <th scope="col" class="px-4 py-4"> Nom</th>
                                <th scope="col" class="px-4 py-4">adresse</th>
                                <th scope="col" class="px-4 py-4"> categorie</th>
                                <th scope="col" class="px-4 py-4">Type</th>
                                <th scope="col" class="px-4 py-4">Ville</th>
                                <th scope="col" class="px-4 py-4">Nom de Responsable</th>
                                <th scope="col" class="px-4 py-4">Téléphone Responsable</th>
                                <th scope="col" class="px-4 py-4">Téléphone Hotel</th>
                                <th scope="col" class="px-4 py-4">Site Web</th>
                                <th scope="col" class="px-4 py-4">Email Hotel</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotels as $hotel)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button id="{{ $hotel->id }}-dropdown-button"
                                            data-dropdown-toggle="{{ $hotel->Nom }}-dropdown"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $hotel->Nom }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm" aria-labelledby="{{ $hotel->id }}-dropdown-button">
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="updatehotelModal{{ $hotel->id }}"
                                                        data-modal-toggle="updatehotelModal{{ $hotel->id }}"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                        Edit
                                                    </button>
                                                </li>

                                                <li>
                                                    <a id="deleteButton" data-modal-target="deleteModal"
                                                        data-modal-toggle="deleteModal"
                                                        data-record-id="{{ $hotel->id }}"
                                                        data-action="{{ route('hotel.delete', $hotel->id) }}"
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($hotel->logo)
                                            <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $hotel->logo) }}" alt="{{ $hotel->Nom }} Logo" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        @else
                                            <div style="width: 100px; height: 100px; border-radius: 50%; background-color: gray; display: flex; align-items: center; justify-content: center;">
                                                <span class="text-xl font-bold">{{ substr($hotel->Nom, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    
                                    <td class="px-4 py-3">{{ $hotel->Nom }}</td>
                                    <td class="px-4 py-3">{{ $hotel->Adresse }}</td>
                                    <td class="px-4 py-3">{{ $hotel->categorie }}</td>
                                    <td class="px-4 py-3">{{ $hotel->typeEtablissement->Libelle ?? 'Unknown' }}</td>
                                    <td>
                                        @if ($hotel->ville)
                                            {{ $hotel->ville->name }}
                                        @else
                                            No Ville Assigned
                                        @endif
                                    </td>
                                    </td>
                                    <td class="px-4 py-3">{{ $hotel->Nom_de_responsable }}</td>
                                    <td class="px-4 py-3">{{ $hotel->tele_de_responsable }}</td>
                                    
                                    
                                    
                                    <td class="px-4 py-3">{{ $hotel->tele_hotel }}</td>
                                    <td class="px-4 py-3">{{ $hotel->siteweb }}</td>
                                    <td class="px-4 py-3">{{ $hotel->email_hotel }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button id="{{ $hotel->id }}-dropdown-button"
                                            data-dropdown-toggle="{{ $hotel->id }}-dropdown"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $hotel->id }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm"
                                                aria-labelledby="{{ $hotel->id }}-dropdown-button">
                                                <li>
                                                    <button type="button"
                                                        data-modal-target="updatehotelModal{{ $hotel->id }}"
                                                        data-modal-toggle="updatehotelModal{{ $hotel->id }}"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">

                                                        Modifier
                                                    </button>
                                                </li>

                                                <li>
                                                    <a id="deleteButton" data-modal-target="deleteModal"
                                                        data-modal-toggle="deleteModal"
                                                        data-record-id="{{ $hotel->id }}"
                                                        data-action="{{ route('hotel.delete', $hotel->id) }}"
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                        Supprimer
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                <!-- Update modal -->
                                <div id="updatehotelModal{{ $hotel->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <!-- Modal header -->
                                            <div
                                                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    modifier hotel
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-target="updatehotelModal{{ $hotel->id }}"
                                                    data-modal-toggle="updatehotelModal{{ $hotel->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form action="{{ route('hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                @method('PUT')
                                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <div>
                                                        <label for="Nom"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                        <input type="text" name="Nom" id="Nom"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Nom" value="{{ $hotel->Nom }}" required>
                                                    </div>
                                                    <div>
                                                        <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo</label>
                                                        <input type="file" name="logo" id="logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" accept="image/*">
                                                    </div>
                                                    
                                                    <div>
                                                        <label for="categorie"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégorie</label>
                                                        <select name="categorie" id="categorie"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            <option value="etoile1"
                                                                {{ $hotel->categorie == 'etoile1' ? 'selected' : '' }}>
                                                                Etoile 1</option>
                                                            <option value="etoile2"
                                                                {{ $hotel->categorie == 'etoile2' ? 'selected' : '' }}>
                                                                Etoile 2</option>
                                                            <option value="etoile3"
                                                                {{ $hotel->categorie == 'etoile3' ? 'selected' : '' }}>
                                                                Etoile 3</option>
                                                            <option value="etoile4"
                                                                {{ $hotel->categorie == 'etoile4' ? 'selected' : '' }}>
                                                                Etoile 4</option>
                                                            <option value="Luxe"
                                                                {{ $hotel->categorie == 'Luxe' ? 'selected' : '' }}>
                                                                Luxe</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="Adresse"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                                                        <input type="text" name="Adresse" id="Adresse"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Adresse" value="{{ $hotel->Adresse }}" required>
                                                    </div>
                                                    <div>
                                                        <label for="ville_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                                                        <select name="ville_id" id="ville_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            required>
                                                            @foreach ($villes as $ville)
                                                                <option value="{{ $ville->id }}"
                                                                    {{ $hotel->ville_id == $ville->id ? 'selected' : '' }}>
                                                                    {{ $ville->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="Nom_de_responsable"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom
                                                            de
                                                            Responsable</label>
                                                        <input type="text" name="Nom_de_responsable"
                                                            id="Nom_de_responsable"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Nom de Responsable"
                                                            value="{{ $hotel->Nom_de_responsable }}" required>
                                                    </div>
                                                    <div>
                                                        <label for="tele_de_responsable"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone
                                                            Responsable</label>
                                                        <input type="text" name="tele_de_responsable"
                                                            id="tele_de_responsable"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Téléphone Responsable"
                                                            value="{{ $hotel->tele_de_responsable }}" required>
                                                    </div>
                                                    <div>
                                                        <label for="tele_hotel"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone
                                                            Hotel</label>
                                                        <input type="text" name="tele_hotel" id="tele_hotel"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Téléphone Hotel"
                                                            value="{{ $hotel->tele_hotel }}" required>
                                                    </div>
                                                    <div>
                                                        <label for="siteweb"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site
                                                            Web</label>
                                                        <input type="text" name="siteweb" id="siteweb"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Site Web" value="{{ $hotel->siteweb }}"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label for="email_hotel"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                                            Hotel</label>
                                                        <input type="email" name="email_hotel" id="email_hotel"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Email Hotel" value="{{ $hotel->email_hotel }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex justify-end pt-2 space-x-2">
                                                    <button type="submit"
                                                        class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:outline-none focus:bg-primary-700">
                                                        modifier
                                                    </button>
                                                    <button type="button"
                                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:bg-gray-300"
                                                        data-modal-target="updatehotelModal{{ $hotel->id }}"
                                                        data-modal-toggle="updatehotelModal{{ $hotel->id }}">
                                                        Annuler
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>


    <!-- Create modal -->
    <div id="createhotelModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add hotel</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-target="createhotelModal" data-modal-toggle="createhotelModal">
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
                <form action="{{ route('add_hotel') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <!-- Other input fields -->
                        <div>
                            <label for="Nom"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="Nom" id="Nom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nom de l'Hotel" required>
                        </div>
                        <div>
                            <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo</label>
                            <input type="file" name="logo" id="logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div>
                            <label for="categorie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie</label>
                            <select name="categorie" id="categorie"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                                <option value="" disabled selected>Select Categorie</option>
                                <option value="etoile1">etoile1</option>
                                <option value="etoile2">etoile2</option>
                                <option value="etoile3">etoile3</option>
                                <option value="etoile4">etoile4</option>
                                <option value="etoile5">etoile5</option>
                                <option value="Luxe">Luxe</option>
                            </select>
                        </div>
                        <div>
                            <label for="Adresse"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                            <input type="text" name="Adresse" id="Adresse"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Adresse de l'Hotel" required>
                        </div>
                        <div>
                            <label for="ville_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                            <select name="ville_id" id="ville_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                                <option value="" disabled selected>Select Ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="Nom_de_responsable"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de
                                Responsable</label>
                            <input type="text" name="Nom_de_responsable" id="Nom_de_responsable"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nom du Responsable" required>
                        </div>
                        <div>
                            <label for="tele_de_responsable"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone
                                Responsable</label>
                            <input type="text" name="tele_de_responsable" id="tele_de_responsable"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Téléphone du Responsable" required>
                        </div>
                        <div>
                            <label for="tele_hotel"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone
                                Hotel</label>
                            <input type="text" name="tele_hotel" id="tele_hotel"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Téléphone de l'Hotel" required>
                        </div>
                        <div>
                            <label for="siteweb"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site Web</label>
                            <input type="text" name="siteweb" id="siteweb"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Site Web de l'Hotel" required>
                        </div>
                        <div>
                            <label for="email_hotel"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Hotel</label>
                            <input type="email" name="email_hotel" id="email_hotel"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Email de l'Hotel" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 110 2h-3v3a1 1 110 2h-3v3a1 1 110-2H6a1 1 110-2h3V6a1 1 110-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add new hotel
                    </button>
                </form>



            </div>
        </div>
    </div>

    <!-- Read modal -->
    <div id="readhotelModal" tabindex="-1" aria-hidden="true"
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
                            data-modal-toggle="readhotelModal">
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
                        {{-- data-record-id="{{ $hotel->id }}"
                data-action="{{ route('hotels.delete', $hotel->id) }}" --}}
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
