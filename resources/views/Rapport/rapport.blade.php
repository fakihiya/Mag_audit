<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport</title>
    <style>
        /* Styles CSS pour les éléments de la page */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 50px 0;
            font-size: 18px;
            text-align: left;
        }

        caption,
        .caption {
            background-color: #031c96;
            margin: 0;
            caption-side: top;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0;
            padding: 10px;
            color: #fff;
        }

        thead td {
            background-color: #031c96;
            color: #fff;
            text-align: center;
        }

        td {
            padding: 5px;
            height: 3rem !important;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            height: 3rem !important;
        }

        .card {
            border: 1px solid #031c96;
            border-radius: 5px;
            padding: 1rem;
            margin: 1rem 0;
            background-color: #f9f9f9;
        }

        .card h2 {
            background-color: #031c96;
            color: #fff;
            padding: 0.5rem;
            margin: -1rem -1rem 1rem -1rem;
            border-radius: 5px 5px 0 0;
        }

        .card ul {
            list-style: none;
            padding: 0;
        }

        .card ul li {
            margin: 0.5rem 0;
        }

        .card ul li strong {
            width: 200px;
            display: inline-block;
        }

        #score-globale {
            background-color: #878787;
        }

        .progress-container {
            width: 80%;
            height: 100% !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .progress-bar,
        .colored-bar {
            height: 5px;
            background-color: rgba(199, 196, 196, 0.694);
            border: 1px solid #747474;
            border-radius: 2px;
        }

        .sauvegarder {
            width: 3.5rem;
            height: 3.5rem;
            background-color: #444cb3;
            color: white;
            font-size: 1.5rem;
            border: solid 2px rgb(149, 148, 148);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            cursor: pointer;
            bottom: 1.5rem;
            right: 2rem;
        }

        .square {
            width: 2.5rem;
            height: 6rem;
            background-color: white;
            border: 1px solid #ddd;
            position: relative;
            margin: 1rem;
        }

        .colored-bars {
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .gauge-container {
            position: relative;
            width: 200px; /* Ajustez la taille selon vos besoins */
            height: 200px; /* Ajustez la taille selon vos besoins */
        }

        #gaugeChart {
            width: 100%;
            height: 100%;
        }

        .needle {
            position: absolute;
            width: 2px; /* Largeur de l'aiguille */
            height: 50%; /* Hauteur de l'aiguille, ajustez selon vos besoins */
            background-color: red; /* Couleur de l'aiguille */
            left: 50%;
            bottom: 50%;
            transform-origin: bottom;
            transform: translateX(-50%) rotate(0deg); /* L'aiguille commencera à 0 degré */
            transition: transform 0.5s ease; /* Animation de transition */
        }
    </style>

</head>

<body style="padding: 1rem">


    <form action="{{ route('visites.store') }}" method="POST">
        @csrf
        <input type="hidden" name="score"
            value="{{ intval($scoresGlobale->total_score_globale) == 0 ? 0 : number_format((intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale)) * 100, 2) }}">
        <input type="hidden" name="mission_id" value="{{ $ID_Mission }}">
        <input type="hidden" name="user_id" value="{{ $auditor->id }}">
        <button type="submit" class="sauvegarder"><img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAArpJREFUWEftlzloVFEUhr+4RlwgIBoUQSs7QVxwjQQriSniAtaKIGJAjYWC2ogLggpBi4iFpWBCColNwA0FcSmS0kIQQQURIZiocb2/nIHH881790xmIIEcGGaYd8+9//vP9t86xpnVjTM8THhAc4AmYBOwEVgDzEqx/BV4Djy2z0NgJDYSsQzp4GPADmBa7Oa27gdwG7gIDBT5FgGabhsdLtoo4vkf4AJwEvhdbn0eoNkhJH3AlojDPEvuBqbagNEspzxA14H9npMca88aU/+55AH6CMx3HOJZ+gZY6mVIMa+lZZKRx9AkIIUjj6EPwMIaxew9sMibQ51Ae40AXQY6vIA0EtSHmqsMSn1IHf+7F1BjYOgTcM7GxlhxqUjOhy59GlgAKGyuPnQo9KGr5qFZdhTYDUx1IlNHvgVcCswMmu8R4IoXkCb09jDd7yUc59oo2WzTflWYT/WpjYeBZ8ATm/aPACmAkrUAPRl+/54X9aGfIdYn7O3G2pemAMcDw2cA/XY3RlGtaS+TvhHFkhEC6bGZwB4L+Qpz1N7635VDArE65TGUEF1PLTTfUmsk4tYCG0zM6VvKIWnyXe8FJGV43+j1MFK0VuxI0giUi6EZ5tgNzCs6JfL5Z6DVUsCth1RBL4ElQBewLfLQcst6gYOARpJCqkp0MfQA2Ar8Mq/lwF77b2VEKJX8L0J76A/a5ybw2vZRMisVlFsuQCpzbbYrVIiSOWlK3HWAWEzfOr7Y24uBdMI3BJ871sPcZV/qO28DzQcCzZpBlZoOl46+BmgkydyA0vLjFXADUCiVW2VvDnagrkvKFQ3nfcCyxNu8AxZ7Q5YnP0rjISsspT4kMJnNzzq/7nmuHKqV/JCk2VmJ/BB6jY5qy49TlV4Uk3RWW36ULY6iq3TasRryI7dSvYAqLftov0lARVT9BcWQhCUh13ZAAAAAAElFTkSuQmCC" /></button>

    </form>

    <div style="display: flex; justify-content: space-between">
        <img style="width: 5rem" src="{{ asset('images/logo_rapport.png') }}" alt="Mag management groupe logo">
        <img style="height: 5rem;border-radius: .5rem" src="{{ asset('storage/' . $hotelLogo) }}" alt="hotel Logo" class="h-10 w-10 rounded-full">
    </div>
    <div class="card">
        <h2 style="text-align: center;">Conditions de visites et profil du client mystère</h2>
        <ul>
            <li><strong>Auditeur :</strong> : {{ $missionActulle->user->Nom }} {{ $missionActulle->user->Prenom }}</li>
            <li><strong>Sexe :</strong> {{ $missionActulle->user->Sexe }}</li>
            <li><strong>Âge :</strong> {{ $missionActulle->user->Age }}</li>
            <li><strong>Profession :</strong> {{ $missionActulle->user->Profession }}</li>
            <li><strong>En couple ou seul :</strong> {{ $missionActulle->user->EnCouple }}</li>
            <li><strong>Visite professionnelle ou personnelle :</strong> {{ $missionActulle->user->TypeVisite }}</li>
            <li><strong>N° de chambre occupée :</strong> {{ $missionActulle->user->Chambre }}</li>
            <li><strong>Réservation effectuée le (date et heure) :</strong> {{ $missionActulle->user->ReservationEffectuee }}</li>
            <li><strong>Canal de réservation (site web ou tél) :</strong> {{ $missionActulle->user->CanalReservation }}</li>
        </ul>
    </div>

    <div class="card">
        <h2 style="text-align: center;">Critères d’évaluation</h2>
        <p>
            Chaque item est noté &laquo; oui &raquo; ou &laquo; non &raquo; ou &laquo; non applicable (NA) &raquo;<br>
            Si l’item n’a pu être mesuré ou observé, &laquo; NA &raquo; sera choisi et n'impactera donc pas votre résultat<br>
            Les cases commentaires renseignées, que l’item soit validé ou non, ont pour but de clarifier le critère
            et/ou d’apporter des préconisations pour l'amélioration de votre prestation.<br>
            Le client mystère note avec le plus d’objectivité possible (Il ne juge pas l’aspect esthétique de la
            décoration par exemple).<br>
            Vous trouverez, ci-après, la synthèse de notre passage au sein de votre établissement.<br>
            Vous trouverez un résumé fait par le client mystère ainsi que les scores des différentes sections.<br>
            Vous trouverez également les scores par départements. Ensuite, vous trouverez la grille complète par section
            avec les notes et commentaires.
        </p>
    </div>


    <div class="card">
        <h2 style="text-align: center;">Résumé de la visite</h2>

        <p>
            {{ $resume }}
        </p>
    </div>

   


    <div class="caption">Rappel visites précédentes</div>

    <div class="squares-container" style="display: flex;">
        @foreach ($visites as $index => $visite)
            @php
                $score = intval($visite->score);
                $color = 'blue';
                if ($score < 30) {
                    $color = 'red';
                } elseif ($score < 50) {
                    $color = 'yellow';
                } elseif ($score < 80) {
                    $color = 'green';
                }
            @endphp
            <div class="square">
                {{ intval($visite->score) }}%
                <div class="colored-bars"
                    style="height: {{ $score }}%; background-color: {{ $color }};"></div>
            </div>
            <div class="visit-number" style="margin-top: 1rem">
                visite T{{ $index + 1 }} <br><br>
                @if ($visite->created_at)
                    {{ $visite->created_at->diffForHumans() }}
                @else
                    N/A
                @endif
            </div>
        @endforeach
    </div>










    <table id="details-table">
        <caption>Détails des Normes</caption>
        <thead>
            <tr>

                <th>Section</th>
                <th>Pondération</th>
                <th>Note section</th>
                <th>Note pondérée</th>
                <th>Moyenne section pondérée</th>
                <th>Note par section</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
                <tr>
                    <td>{{ $score->item->libelle }}</td>
                    <td>_</td>
                    <td>{{ intval($score->total_score_conforme) }} / {{ intval($score->total_score) }}</td>
                    <td>
                        @if ($score->total_score != 0)
                            <span id="percentage_{{ $loop->iteration }}">
                                {{ number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100 }}%
                            </span>
                        @else
                            0%
                        @endif
                    </td>
                    <td>
                        <div class="progress-container"
                            style="height: 100% !important display : flex !important; flex-wrap: nowrap">
                            <div class="progress-bar" style="width: 70%; ">
                                <div id="coloredBar_{{ $loop->iteration }}" class="colored-bar" style="width: 0%;">
                                </div>
                                {{-- @if ($score->total_score != 0)
                        <span id="percentage_{{$loop->iteration}}">
                            {{ number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100}}%
                        </span>
                    @else
                        0%
                    @endif --}}
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($score->total_score != 0)
                            <span id="percentage_{{ $loop->iteration }}">
                                {{ number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100 }}%
                            </span>
                        @else
                            0%
                        @endif
                        {{-- <div class="progress-bar" style="width: 100%;">
                        <div id="coloredBar_{{$loop->iteration}}_bg" class="colored-bar" style="width: 0%;"></div>
                    </div> --}}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td id="score-globale">Score Globale</td>
                <td id="score-globale">_</td>
                <td id="score-globale">{{ intval($scoresGlobale->total_score_conforme_globale) }} /
                    {{ intval($scoresGlobale->total_score_globale) }}</td>
                <td id="score-globale">
                    @if ($scoresGlobale->total_score_globale != 0)
                        <span>
                            {{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }}%
                        </span>
                    @else
                        0%
                    @endif
                </td>

                {{-- <div class="progress-container" style="height: 100% !important display : flex !important; flex-wrap: nowrap">
            <div class="progress-bar" style="width: 70%; ">
                <div id="coloredBar_{{$loop->iteration}}" class="colored-bar" style="width: 0%;"></div>

            </div>
        </div>
    </td>
        <td>
            <div class="progress-bar" style="width: 100%;">
                <div id="coloredBar_{{$loop->iteration}}_bg" class="colored-bar" style="width: 0%;"></div>
            </div>
        </td> --}}
            </tr>


        </tbody>
    </table>



    <table id="details-table">
        <caption>Détails des Normes</caption>
        <thead>
            <tr>
                <th>Norme ID</th>
                <th>Réponse</th>
                <th>Score</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($normes as $norme)
                <tr>
                    <td style="width: 50% !important">{{ $norme->norm->Normes }}</td>
                    @if ($norme->verifie == 'conforme')
                        <td>*Oui</td>
                    @elseif($norme->verifie == 'non_conforme' || $norme->verifie == 'Non inspecté')
                        <td>*Non</td>
                    @else
                        <td></td>
                    @endif

                    @if ($norme->verifie == 'conforme')
                        <td>{{ $norme->score }}/{{ $norme->score }}</td>
                    @elseif($norme->verifie == 'non_conforme' || $norme->verifie == 'Non inspecté')
                        <td>0.00/{{ $norme->score }}</td>
                    @else
                        <td></td>
                    @endif

                    <td>{{ $norme->remarques }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <button id="printButton"
        style="position: fixed; bottom: 1.5rem; right: 6rem; width: 3.5rem; height: 3.5rem; background-color: #444cb3; color: white; font-size: 1.5rem; border: solid 2px rgb(149, 148, 148); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer;">🖨️</button> --}}

    <script>
        function getColor(percentage) {
            if (percentage >= 75) {
                return 'green';
            } else if (percentage >= 50) {
                return 'yellow';
            } else if (percentage >= 25) {
                return 'orange';
            } else {
                return 'red';
            }
        }

        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>

    @foreach ($scores as $score)
        <script>
            var percentage{{ $loop->iteration }} =
                {{ $score->total_score != 0 ? number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100 : 0 }};
            var coloredBar{{ $loop->iteration }} = document.getElementById('coloredBar_{{ $loop->iteration }}');
            coloredBar{{ $loop->iteration }}.style.width = percentage{{ $loop->iteration }} + '%';
            coloredBar{{ $loop->iteration }}.style.backgroundColor = getColor(percentage{{ $loop->iteration }});

            var coloredBarBg{{ $loop->iteration }} = document.getElementById('coloredBar_{{ $loop->iteration }}_bg');
            coloredBarBg{{ $loop->iteration }}.style.width = percentage{{ $loop->iteration }} + '%';
            coloredBarBg{{ $loop->iteration }}.style.backgroundColor = getColor(percentage{{ $loop->iteration }});
        </script>
    @endforeach 
    <script>



</body>



</html>