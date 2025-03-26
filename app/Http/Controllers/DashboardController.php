<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of clients
        $clientCount = Client::count();
        $produitCount = Produit::count();
        $commandeCount = Commande::count();

        // Récupérer les 3 derniers produits
        $products = Produit::latest()->take(3)->get();

        // Pass the client count to the view
        return view('dashboard', compact('clientCount', 'produitCount', 'commandeCount', 'products'));



    

    }
}
