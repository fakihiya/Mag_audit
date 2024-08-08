@extends('layouts.app')
@section('content')
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
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Mission</h3>
                <form action="{{ route('missions.update', $mission->ID_Mission) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="Description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea name="Description" id="Description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ old('Description', $mission->Description) }}</textarea>
                    </div>
                    <div>
                        <label for="Statut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                        <select name="Statut" id="Statut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="En cours" @if(old('Statut', $mission->Statut) == 'désignée') selected @endif>désignée</option>
                            <option value="En cours" @if(old('Statut', $mission->Statut) == 'En cours') selected @endif>En cours</option>
                            <option value="Terminée" @if(old('Statut', $mission->Statut) == 'Terminée') selected @endif>Terminée</option>
                            <option value="Annulée" @if(old('Statut', $mission->Statut) == 'Annulée') selected @endif>Annulée</option>
                        </select>
                    </div>
                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auditeur</label>
                        <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Choisir un auditeur</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(old('user_id', $mission->user_id) == $user->id) selected @endif>{{ $user->Nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="legende_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Légende</label>
                        <select name="legende_id" id="legende_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Choisir une légende</option>
                            @foreach($legendes as $legende)
                            <option value="{{ $legende->id }}" @if(old('legende_id', $mission->legende_id) == $legende->id) selected @endif>{{ $legende->Description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="hotel_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de l'hôtel</label>
                        <select name="hotel_id" id="hotel_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Choisir un hôtel</option>
                            @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" @if(old('hotel_id', $mission->hotel_id) == $hotel->id) selected @endif>{{ $hotel->Nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-4 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Update</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
