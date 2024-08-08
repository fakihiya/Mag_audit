
@extends('layouts.app')

@section('content')

<div class="bg-dark w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">

    <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
        <div class="p-2 md:p-4">
            <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg bg-white dark:bg-gray-800 shadow-lg">
                {{-- <h1 class="pl-6 text-2xl font-bold sm:text-xl dark:text-white mb-4">Profil utilisateur</h1> --}}
                <div class="grid max-w-2xl mx-auto mt-6 space-y-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="col-span-full">
                                <label for="Nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                <input type="text" name="Nom" id="Nom"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="First Name" value="{{ old('Nom', $user->Nom) }}" required>
                            </div>
                            <div class="col-span-full">
                                <label for="Prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" name="Prenom" id="Prenom"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Last Name" value="{{ old('Prenom', $user->Prenom) }}" required>
                            </div>
                            <div class="col-span-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div>
                                <label for="Sexe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                                <select name="Sexe" id="Sexe"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                    <option value="Masculin" {{ $user->Sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="Féminin" {{ $user->Sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>

                            <div>
                                <label for="Age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                <input type="number" name="Age" id="Age"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Age" value="{{ old('Age', $user->Age) }}" required>
                            </div>

                            <div>
                                <label for="Profession" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profession</label>
                                <input type="text" name="Profession" id="Profession"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Profession" value="{{ old('Profession', $user->Profession) }}" required>
                            </div>

                            <div>
                                <label for="EnCouple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">En couple</label>
                                <select name="EnCouple" id="EnCouple"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                    <option value="En couple" {{ $user->EnCouple == 'En couple' ? 'selected' : '' }}>En couple</option>
                                    <option value="Seul" {{ $user->EnCouple == 'Seul' ? 'selected' : '' }}>Seul</option>
                                </select>
                            </div>

                            <div>
                                <label for="TypeVisite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de visite</label>
                                <select name="TypeVisite" id="TypeVisite"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                    <option value="Visite professionnelle" {{ $user->TypeVisite == 'Visite professionnelle' ? 'selected' : '' }}>Visite professionnelle</option>
                                    <option value="Visite personnelle" {{ $user->TypeVisite == 'Visite personnelle' ? 'selected' : '' }}>Visite personnelle</option>
                                </select>
                            </div>

                            <div>
                                <label for="Chambre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chambre</label>
                                <input type="text" name="Chambre" id="Chambre"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Chambre" value="{{ old('Chambre', $user->Chambre) }}" required>
                            </div>

                            <div>
                                <label for="ReservationEffectuee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de réservation</label>
                                <input type="datetime-local" name="ReservationEffectuee" id="ReservationEffectuee"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       value="{{ old('ReservationEffectuee', \Carbon\Carbon::parse($user->ReservationEffectuee)->format('Y-m-d\TH:i')) }}" required>
                            </div>

                            <div>
                                <label for="CanalReservation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Canal de réservation</label>
                                <select name="CanalReservation" id="CanalReservation"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                    <option value="site web" {{ $user->CanalReservation == 'site web' ? 'selected' : '' }}>Site web</option>
                                    <option value="tél" {{ $user->CanalReservation == 'tél' ? 'selected' : '' }}>Téléphone</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                    class="w-full text-white inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition duration-150 ease-in-out">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                          clip-rule="evenodd" />
                                </svg>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>

@endsection
