@extends('layouts.app')

@section('content')
    <div class="m-6">
        <header class="mb-10 text-center">
        </header>



        <div class="flex flex-wrap -mx-6">

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6 sm:mb-0">
                <a href="{{ route('showusers') }}">
                    <div
                        class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100 dark:bg-gray-800 transition-transform transform hover:scale-105">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="mx-5">
                            <a class="text-2xl font-semibold text-gray-700 dark:text-slate-100">{{ $numberOfUsers }}</a>
                            <div class="text-gray-500 dark:text-slate-100">Nombre d'utilisateurs :</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6 sm:mb-0">
                <a href="{{ route('showmisson') }}">
                    <div
                        class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100 dark:bg-gray-800 transition-transform transform hover:scale-105">
                        <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700 dark:text-slate-100">{{ $numberOfMissions }}
                            </h4>
                            <div class="text-gray-500 dark:text-slate-100">Mes missions : </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <a href="{{ route('showHotels') }}">
                    <div
                        class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100 dark:bg-gray-800 transition-transform transform hover:scale-105">
                        <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                            </svg>
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700 dark:text-slate-100">{{ $numberOfHotels }}</h4>
                            <div class="text-gray-500 dark:text-slate-100">Nombre des Hotels : </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="w-full mt-6 px-6">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100 dark:bg-gray-800">
                    <canvas id="missionsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to enhance the page, for example, initializing chart data
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('missionsChart').getContext('2d');
            const missionsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Missions',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
