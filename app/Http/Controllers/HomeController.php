<?php

use App\Models\Produit;

public function index()
{
    // Récupérer les derniers produits
    $products = Produit::latest()->take(6)->get();  // Récupère les 6 derniers produits
    
    return view('welcome', compact('products'));  // Passer la variable à la vue 'welcome'
}
