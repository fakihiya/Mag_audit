<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapport PDF</title>
    <style>
        /* Include all your CSS styles here */

        * {
        font-size: 14px;
    }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 50px 0;
            font-size: 18px;
            text-align: left;
        }
        caption, .caption {
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
        h1 { font-size: 24px; }
h2 { font-size: 20px; }
        /* Include other styles as needed */
    </style>
</head>
<body style="padding: 1rem">
    <div style="position: relative; width: 100%; height: 100px; margin-bottom: 60px;">
        <div style="position: absolute; left: 0; top: 0;">
            <img style="width: 150px;" src="{{ public_path('images/logo_rapport.png') }}" alt="Mag Management Groupe logo">
        </div>
        <div style="position: absolute; right: 0; top: 0;:">
            <img style="height: 80px; border-radius: 8px;" src="{{ public_path('storage/' . $hotelLogo) }}" alt="Hotel Logo">
        </div>
    </div>

    <div class="card">
        <h2 style="text-align: center;">Conditions de visites et profil du client mystère</h2>
        <ul>
            <li><strong>Auditeur :</strong> {{ $missionActulle->user->Nom }} {{ $missionActulle->user->Prenom }}</li>
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
        <h2 style="text-align: center;">Critères d'évaluation</h2>
        <p>
            Chaque item est noté « oui » ou « non » ou « non applicable (NA) »<br>
            Si l'item n'a pu être mesuré ou observé, « NA » sera choisi et n'impactera donc pas votre résultat<br>
            Les cases commentaires renseignées, que l'item soit validé ou non, ont pour but de clarifier le critère
            et/ou d'apporter des préconisations pour l'amélioration de votre prestation.<br>
            Le client mystère note avec le plus d'objectivité possible (Il ne juge pas l'aspect esthétique de la
            décoration par exemple).<br>
            Vous trouverez, ci-après, la synthèse de notre passage au sein de votre établissement.<br>
            Vous trouverez un résumé fait par le client mystère ainsi que les scores des différentes sections.<br>
            Vous trouverez également les scores par départements. Ensuite, vous trouverez la grille complète par section
            avec les notes et commentaires.
        </p>
    </div>

    <div class="card" style="margin-bottom: 15rem">
        <h2 style="text-align: center;">Résumé de la visite</h2>
        <p>{{ $resume }}</p>
    </div>

    <div class="caption">Rappel visites précédentes</div>

    <div style="font-family: Arial, sans-serif; width: 100%; margin-top: 15px">
        {{-- <div style="background-color: blue; color: white; padding: 5px; font-weight: bold;">
            Rappel visites précédentes
        </div> --}}
        <div style="display: flex; flex-direction: column; padding: 20px;">
            @foreach ($visites as $index => $visite)
                @php
                    $score = intval($visite->score);
                    $color = $score < 30 ? 'red' : 'white';
                @endphp
                <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                    <div style="width: 20px; height: 20px; background-color: {{ $color }}; border: 1px solid #ddd; margin-right: 10px;"></div>
                    <div style="flex-grow: 1;">
                        <span style="font-weight: bold;">{{ $score }}%</span>
                        <span style="margin-left: 10px;">visite T{{ $index + 1 }}</span>
                        <span style="color: gray; font-size: 0.9em; margin-left: 10px;">
                            @if ($visite->created_at)
                                {{ $visite->created_at->diffForHumans() }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
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
                            {{ number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100 }}%
                        @else
                            0%
                        @endif
                    </td>
                    <td>
                        <div style="width: 70%; height: 5px; background-color: rgba(199, 196, 196, 0.694); border: 1px solid #747474; border-radius: 2px;">
                            <div style="width: {{ $score->total_score != 0 ? (intval($score->total_score_conforme) / intval($score->total_score)) * 100 : 0 }}%; height: 100%; background-color: 
                                {{ $score->total_score != 0 ? (intval($score->total_score_conforme) / intval($score->total_score)) * 100 >= 75 ? 'green' : ((intval($score->total_score_conforme) / intval($score->total_score)) * 100 >= 50 ? 'yellow' : ((intval($score->total_score_conforme) / intval($score->total_score)) * 100 >= 25 ? 'orange' : 'red')) : 'red' }};">
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($score->total_score != 0)
                            {{ number_format(intval($score->total_score_conforme) / intval($score->total_score), 2) * 100 }}%
                        @else
                            0%
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr style="background-color: #878787;">
                <td>Score Globale</td>
                <td>_</td>
                <td>{{ intval($scoresGlobale->total_score_conforme_globale) }} / {{ intval($scoresGlobale->total_score_globale) }}</td>
                <td>
                    @if ($scoresGlobale->total_score_globale != 0)
                        {{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }}%
                    @else
                        0%
                    @endif
                </td>
                <td></td>
                <td></td>
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
</body>
</html>