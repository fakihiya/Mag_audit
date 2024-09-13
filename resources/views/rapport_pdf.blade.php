<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport PDF</title>
    <style>
        /* Add your CSS styles here, optimized for PDF rendering */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>
    <h1>Rapport for {{ $hotel_categorie }}</h1>
    
    <!-- Include your report content here, similar to rapport.blade.php but without interactive elements -->

    <table>
        <thead>
            <tr>
                <th>Section</th>
                <th>Pondération</th>
                <th>Note section</th>
                <th>Note pondérée</th>
                <th>Note par section</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores->groupBy('item.category.id') as $category_id => $category_scores)
                <!-- Add your table rows here -->
            @endforeach
        </tbody>
    </table>

    <!-- Add more sections of your report -->

</body>
</html>