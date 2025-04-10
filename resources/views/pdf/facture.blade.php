<!DOCTYPE html>
<html>
<head>
    <title>Facture Commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Facture pour la commande #{{ $commande->id }}</h1>
    <p>Date: {{ $commande->created_at }}</p>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom_produit }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ $produit->prix_unitaire }}</td>
                    <td>{{ $produit->pivot->quantite * $produit->prix_unitaire }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
