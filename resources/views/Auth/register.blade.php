<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="h-full bg-gray-400 dark:bg-gray-900">
        @if ($errors->has('ReservationEffectuee'))
            <div class="alert alert-danger">
                @foreach ($errors->get('ReservationEffectuee') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif
        <div class="mx-auto">
            <div class="flex justify-center px-6 py-12">
                <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                    <div class="w-full h-auto bg-gray-400 dark:bg-gray-800 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                        style="background-image: url('https://source.unsplash.com/Mv9hjnEUHR4/600x800')"></div>
                    <div class="w-full lg:w-7/12 bg-white dark:bg-gray-700 p-5 rounded-lg lg:rounded-l-none">
                        <h3 class="py-4 text-2xl text-center text-gray-800 dark:text-white">Create an Account!</h3>
                        <form class="px-8 pt-6 pb-8 mb-4 bg-white dark:bg-gray-800 rounded" method="POST"
                            action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                        for="Nom">Nom</label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="Nom" type="text" name="Nom" placeholder="Nom" required />
                                    @if ($errors->has('Nom'))
                                        <div class="alert alert-danger">
                                            @foreach ($errors->get('Nom') as $message)
                                                <p>{{ $message }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                        for="Prenom">Prenom</label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="Prenom" type="text" name="Prenom" placeholder="Prenom" required />

                                    @if ($errors->has('Nom'))
                                        <div class="alert alert-danger">
                                            @foreach ($errors->get('Prenom') as $message)
                                                <p>{{ $message }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="email">Email</label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="email" type="email" name="email" placeholder="Email" required />
                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('Email') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                        for="MotDePasse">Mot De Passe</label>
                                    <input
                                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="MotDePasse" type="password" name="MotDePasse"
                                        placeholder="******************" required />
                                    <p class="text-xs italic text-red-500">Please choose a password.</p>
                                </div>

                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('MotDePasse') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                {{-- <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white" for="MotDePasse_confirmation">Confirm Mot De Passe</label>
                                <input class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="MotDePasse_confirmation" type="password" name="MotDePasse_confirmation" placeholder="******************" required />
                            </div> --}}
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                        for="Sexe">Sexe</label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="Sexe" type="text" name="Sexe" placeholder="Sexe" />
                                    @if ($errors->has('Nom'))
                                        <div class="alert alert-danger">
                                            @foreach ($errors->get('Sexe') as $message)
                                                <p>{{ $message }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                        for="Age">Age</label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="Age" type="number" name="Age" placeholder="Age" />
                                    @if ($errors->has('Nom'))
                                        <div class="alert alert-danger">
                                            @foreach ($errors->get('Age') as $message)
                                                <p>{{ $message }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="Profession">Profession</label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="Profession" type="text" name="Profession" placeholder="Profession" />
                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('Profession') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="EnCouple">En Couple</label>
                                <select
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="EnCouple" name="EnCouple" required>
                                    <option value="">Select...</option>
                                    <option value="En couple">En couple</option>
                                    <option value="Seul">Seul</option>
                                </select>

                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('EnCouple') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="TypeVisite">Type Visite</label>
                                <select
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="TypeVisite" name="TypeVisite" required>
                                    <option value="">Select...</option>
                                    <option value="Visite professionnelle">Visite professionnelle</option>
                                    <option value="Visite personnelle">Visite personnelle</option>
                                </select>

                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('TypeVisite') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="Chambre">Chambre</label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="Chambre" type="number" name="Chambre" placeholder="Chambre" />
                                @if ($errors->has('Nom'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('Chambre') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="ReservationEffectuee">Reservation Effectuee</label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="ReservationEffectuee" type="datetime-local" name="ReservationEffectuee"
                                    placeholder="Reservation Effectuee" />

                                @if ($errors->has('ReservationEffectuee'))
                                    <div class="alert alert-danger">
                                        @foreach ($errors->get('ReservationEffectuee') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white"
                                    for="CanalReservation">Canal Reservation</label>
                                <select
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-white border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="CanalReservation" name="CanalReservation" required>
                                    <option value="">Select...</option>
                                    <option value="site web">site web</option>
                                    <option value="tél">tél</option>
                                </select>

                                {{-- @if ($errors->has('Nom'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert"">
                                        @foreach ($errors->get('CanalReservation') as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                @endif --}}
                            </div>
                            <div class="mb-6 text-center">
                                <button
                                    class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 dark:bg-blue-700 dark:text-white dark:hover:bg-blue-900 focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Register Account
                                </button>
                            </div>
                            <hr class="mb-6 border-t" />
                            <div class="text-center">
                                <a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
                                    href="#">
                                    Forgot Password?
                                </a>
                            </div>
                            <div class="text-center">
                                <a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
                                    href="./index.html">
                                    Already have an account? Login!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
