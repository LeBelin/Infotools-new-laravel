<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use TCPDF;

class CommandeController extends Controller
{
    public function showInvoice($commandeId)
    {
        // Récupérer la commande avec ses produits associés et le client
        $commande = Commande::with('produits', 'client')->find($commandeId);

        // Vérifier si la commande existe
        if (!$commande) {
            return redirect()->back()->with('error', 'Commande non trouvée');
        }

        // Créer une instance de TCPDF
        $pdf = new TCPDF();

        // Ajouter une page
        $pdf->AddPage();

        // Ajouter le logo
        $logoPath = public_path('logo.png');  // Le chemin de l'image logo.png dans le dossier public/images
        $pdf->Image($logoPath, 10, 5, 40, 25);  // Paramètres : chemin, position X, position Y, largeur, hauteur

        // Définir la police
        $pdf->SetFont('helvetica', 'B', 16); // Titre plus gros et en gras

        // Titre de la facture
        $pdf->Cell(200, 10, "Facture - Commande N°{$commande->id}", 0, 1, 'C');

        // Infos sur la commande (Client, Date)
        $pdf->Ln(10); // Saut de ligne
        $pdf->SetFont('helvetica', '', 12); // Police plus petite pour les infos
        $pdf->Cell(100, 10, "Client: {$commande->client->nom}");
        $pdf->Ln(10);
        $pdf->Cell(100, 10, "Date: {$commande->created_at->format('d/m/Y')}");
        $pdf->Ln(10);

        // Ligne de séparation
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Détails des produits
        $pdf->Ln(10); // Saut de ligne
        $pdf->SetFont('helvetica', 'B', 12); // En-têtes de table en gras
        $pdf->Cell(100, 10, "Produit", 1, 0, 'C');
        $pdf->Cell(50, 10, "Quantité", 1, 0, 'C');
        $pdf->Cell(40, 10, "Prix Unitaire", 1, 1, 'C');

        // Variables pour calculer le total
        $total = 0;

        // Détails des produits (utilisation de pivot pour accéder à la quantité et au prix)
        $pdf->SetFont('helvetica', '', 12); // Police normale pour les produits
        foreach ($commande->produits as $produit) {
            $prixUnitaire = $produit->pivot->prix_unitaire;
            $quantite = $produit->pivot->quantite;

            // Calculer le total pour chaque produit (prix unitaire * quantité)
            $totalProduit = $prixUnitaire * $quantite;

            // Ajouter au total global
            $total += $totalProduit;

            // Affichage des informations pour chaque produit
            $pdf->Cell(100, 10, $produit->nom_produit, 1);
            $pdf->Cell(50, 10, $quantite, 1, 0, 'C');
            $pdf->Cell(40, 10, number_format($prixUnitaire, 2, ',', ' ') . ' €', 1, 1, 'C');
        }

        // Ligne de séparation avant le total
        $pdf->Ln(5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Affichage du total
        $pdf->Ln(10); // Saut de ligne
        $pdf->SetFont('helvetica', 'B', 12); // Mettre en gras pour le total
        $pdf->Cell(150, 10, "Total", 0, 0, 'R');
        $pdf->Cell(40, 10, number_format($total, 2, ',', ' ') . ' €', 0, 1, 'C');

        // Retourner le PDF dans le navigateur (sans téléchargement)
        return response($pdf->Output('facture_commande_' . $commande->id . '.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}
