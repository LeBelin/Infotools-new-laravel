<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Flux;

class CommandeCreate extends Component
{
    public $client_id;
    public $produit_id;
    public $quantite = 1;  // Initialiser à 1 pour ne pas avoir de valeur vide
    public $montant = 0;
    public $showSuccessMessage = false;
    public $clients;
    public $produits;
    public $prix_produit = 0;

    public function mount()
    {
        // Charger les clients et produits depuis la base de données
        $this->clients = Client::all();
        $this->produits = Produit::all();
    }

    public function updatedProduitId($produitId)
    {
        // Récupérer le prix du produit sélectionné
        $produit = Produit::find($produitId);
        $this->prix_produit = $produit ? $produit->prix : 0;

        // Recalculer le montant à chaque fois que le produit change
        $this->updateMontant();
    }

    public function updatedQuantite($quantite)
    {
        // Recalculer le montant chaque fois que la quantité change
        $this->updateMontant();
    }

    public function updateMontant()
    {
        // Calculer le montant en fonction de la quantité et du prix
        $this->montant = $this->quantite * $this->prix_produit;
    }

    public function render()
    {
        return view('livewire.commande-create');
    }

    public function submit()
    {
        // Valider les données du formulaire
        $this->validate([
            'client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required|numeric|min:1',
            'montant' => 'required|numeric',
        ]);

        // Ajouter la commande dans la base de données
        Commande::create([
            'client_id' => $this->client_id,
            'produit_id' => $this->produit_id,
            'quantite' => $this->quantite,
            'montant' => $this->montant,
        ]);

        // Afficher le message de succès
        $this->showSuccessMessage = true;

        // Réinitialiser uniquement les autres champs
        $this->resetForm();
    }

    public function resetForm()
    {
        // Réinitialiser les champs sans toucher à la quantité
        $this->client_id = '';
        $this->produit_id = '';
        $this->montant = 0;
        $this->prix_produit = 0;
    }
}
