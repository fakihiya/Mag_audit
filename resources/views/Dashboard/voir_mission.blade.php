@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Mission Details</h1>
        <div class="space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">Description:</span>
                <span class="text-gray-900 dark:text-white">{{ $mission->Description }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">Statut:</span>
                <span class="text-gray-900 dark:text-white">{{ $mission->Statut }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">Auditeur:</span>
                <span class="text-gray-900 dark:text-white">{{ $mission->user->Nom }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">Legende:</span>
                <span class="text-gray-900 dark:text-white">{{  $mission->legende->Description }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">Nom de l'hôtel:</span>
                <span class="text-gray-900 dark:text-white">{{ $mission->Hotel->Nom }}</span>
            </div>
        </div>
    </div>


    @php
    $url = route('shownorm', ['hotel_id' => $mission->hotel_id, 'legende_id' => $mission->legende_id]) . '?ID_Mission=' . $mission->ID_Mission;
@endphp

<div class="mt-6">
    <a href="{{ $url }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-4 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Commencer mission
    </a>
</div>

{{--
    
    <div id="mission-data" class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Mission Data</h2>
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead>
                <tr>
                    <th class="px-4 py-2">Item</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Conforme</th>
                </tr>
            </thead>
            <tbody id="mission-data-body">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div> --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ID_Mission = @json($mission->ID_Mission);

        // Fetch mission data from local storage
        const itemCountsKey = `itemCounts_${ID_Mission}`;
        const itemCounts = JSON.parse(localStorage.getItem(itemCountsKey)) || {};

        const missionDataBody = document.getElementById('mission-data-body');
        missionDataBody.innerHTML = '';

        Object.keys(itemCounts).forEach(itemId => {
            const item = itemCounts[itemId];
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="border px-4 py-2">${itemId}</td>
                <td class="border px-4 py-2">${item.total}</td>
                <td class="border px-4 py-2">${item.conforme}</td>
            `;
            missionDataBody.appendChild(row);
        });
    });
</script>
@endsection
