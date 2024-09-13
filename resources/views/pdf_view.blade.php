<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport PDF</title>
    <style>
        @page { margin: 0px; }
        body { margin: 0px; font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        caption, .caption { background-color: #031c96; color: #fff; font-size: 16px; font-weight: bold; padding: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .card { border: 1px solid #031c96; border-radius: 5px; padding: 10px; margin: 10px 0; background-color: #f9f9f9; }
        .card h2 { background-color: #031c96; color: #fff; padding: 5px; margin: -10px -10px 10px -10px; border-radius: 5px 5px 0 0; font-size: 14px; text-align: center; }
        .progress-bar { width: 100%; background-color: #f3f3f3; border-radius: 5px; overflow: hidden; }
        .progress { height: 20px; border-radius: 5px; }
    </style>
</head>
<body style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <img style="width: 100px;" src="{{ public_path('images/logo_rapport.png') }}" alt="Mag management groupe logo">
        <img style="height: 80px; border-radius: 8px;" src="{{ public_path('storage/' . $hotelLogo) }}" alt="Hotel Logo">
    </div>

    <div class="card">
        <h2>Conditions de visites et profil du client mystère</h2>
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
        <h2>Critères d'évaluation</h2>
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

    <div class="card">
        <h2>Résumé de la visite</h2>
        <p>{{ $resume }}</p>
    </div>

    <div style="page-break-before: always;"></div>

    <div class="caption">Moyenne générale de la visite {{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }}%</div>

    <div class="caption">Rappel visites précédentes</div>
    <div style="display: flex; justify-content: space-around; margin-top: 20px;">
        @foreach ($visites as $index => $visite)
            @php
                $score = intval($visite->score);
                $color = $score < 50 ? 'red' : ($score < 70 ? 'orange' : 'green');
            @endphp
            <div style="text-align: center;">
                <div style="width: 50px; height: 100px; background-color: #f2f2f2; margin: 0 auto; position: relative;">
                    <div style="width: 100%; height: {{ $score }}%; background-color: {{ $color }}; position: absolute; bottom: 0;"></div>
                </div>
                <p>{{ $score }}%</p>
                <p>visite T{{ $index + 1 }}</p>
                <p>{{ $visite->created_at ? $visite->created_at->diffForHumans() : 'N/A' }}</p>
            </div>
        @endforeach
    </div>

    <table>
        <caption>Détails des Normes</caption>
        <thead>
            <tr>
                <th>Section</th>
                <th>Pondération</th>
                <th>Note section</th>
                <th>Note pondérée</th>
                <th>Progression</th>
                <th>Note par section</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores->groupBy('item.category.id') as $category_id => $category_scores)
                @php
                    $category = $category_scores->first()->item->category;
                    $category_ponderation = $category->ponderation;
                    $category_total_score_conforme = $category_scores->sum('total_score_conforme');
                    $category_total_score = $category_scores->sum('total_score');
                    $category_percentage = $category_total_score > 0 ? ($category_total_score_conforme / $category_total_score) * 100 : 0;
                    $category_weighted_score = ($category_percentage * $category_ponderation) / 100;
                @endphp
                <tr>
                    <td><strong>{{ $category->libele }}</strong></td>
                    <td>{{ $category_ponderation }}</td>
                    <td></td>
                    <td>{{ number_format($category_weighted_score, 2) }}</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $category_percentage }}%; background-color: {{ $category_percentage >= 70 ? 'green' : ($category_percentage >= 50 ? 'orange' : 'red') }};"></div>
                        </div>
                        {{ number_format($category_percentage, 2) }}%
                    </td>
                    <td>
                        @php
                            $total_conforme = $category_scores->sum('total_conforme');
                            $total_non_conforme = $category_scores->sum('total_non_conforme');
                            $total = $total_conforme + $total_non_conforme;
                        @endphp
                        {{ $total > 0 ? number_format(($total_conforme / $total) * 100, 2) : 0 }}%
                    </td>
                </tr>
                @foreach ($category_scores as $score)
                    <tr>
                        <td>{{ $score->item->libelle }}</td>
                        <td></td>
                        <td>{{ intval($score->total_score_conforme) }} / {{ intval($score->total_score) }}</td>
                        <td>{{ number_format(($score->total_score_conforme / $score->total_score) * $category_ponderation / 100, 2) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
            <tr style="background-color: #878787;">
                <td>Score Globale</td>
                <td>_</td>
                <td>{{ intval($scoresGlobale->total_score_conforme_globale) }} / {{ intval($scoresGlobale->total_score_globale) }}</td>
                <td colspan="3">
                    {{ number_format(($scoresGlobale->total_score_conforme_globale / $scoresGlobale->total_score_globale) * 100, 2) }}%
                </td>
            </tr>
        </tbody>
    </table>

    @foreach ($normes->groupBy('item.category.libele') as $category => $groupedNormes)
        <table>
            <thead>
                <tr style="background-color: #1e39c2; color: #ccc;">
                    <th>{{ $category }}</th>
                    <th>Réponse</th>
                    <th>Score</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedNormes->groupBy('item.libelle') as $item => $itemNormes)
                    <tr>
                        <td colspan="4" style="font-weight: bold; background-color: #5480b1; color: #000000;">
                            {{ $item }}
                        </td>
                    </tr>
                    @foreach ($itemNormes as $norme)
                        <tr>
                            <td>{{ $norme->norm->Normes }}</td>
                            <td>
                                @if ($norme->verifie == 'conforme')
                                    *Oui
                                @elseif($norme->verifie == 'non_conforme')
                                    *Non
                                @else
                                    *N/A
                                @endif
                            </td>
                            <td>
                                @if ($norme->verifie == 'conforme')
                                    {{ $norme->score }}/{{ $norme->score }}
                                @elseif($norme->verifie == 'non_conforme')
                                    0.00/{{ $norme->score }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="color: #0653fa;">{{ $norme->remarques }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>