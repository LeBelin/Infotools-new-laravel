<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Flux;

class CommandeCreate extends Component
{
    public $clients;
    public $client_id;
    public $produits = [];
    public $montant_total = 0.00;
    public $produitList;
    public $showSuccessMessage = false;

    public function mount()
    {
        // Charge les clients
        $this->clients = Client::all();
        $this->produitList = Produit::all();
    
        // Initialisation de la variable produits
        $this->produits = [
            ['produit_id' => '', 'quantite' => 1, 'prix_unitaire' => 0.00],
        ];
    }
    
    // Lorsqu'il y a un changement dans la liste des produits, on met à jour le prix unitaire et on recalcule le total
    public function updatedProduits()
    {
        foreach ($this->produits as $index => $produit) {
            if (!empty($produit['produit_id'])) {
                // Trouver le produit dans la base de données et mettre à jour le prix unitaire
                $p = Produit::find($produit['produit_id']);
                $this->produits[$index]['prix_unitaire'] = $p ? $p->prix : 0.00;
            }
        }

        // Calculer le montant total
        $this->calculateTotal();
    }

    // Calcul du montant total de la commande en fonction des produits
    public function calculateTotal()
    {
        $this->montant_total = collect($this->produits)->sum(function ($p) {
            return (float) $p['prix_unitaire'] * (int) $p['quantite'];
        });
    }

    // Ajouter un produit à la commande
    public function addProduit()
    {
        $this->produits[] = ['produit_id' => '', 'quantite' => 1, 'prix_unitaire' => 0.00];
    }

    // Supprimer un produit de la commande
    public function removeProduit($index)
    {
        unset($this->produits[$index]);
        $this->produits = array_values($this->produits); // Réindexation de l'array
        $this->calculateTotal();
    }

    // Soumettre la commande
    public function submit()
    {
        // Validation des données de la commande
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Création de la commande
            $commande = Commande::create([
                'client_id' => $this->client_id,
                'montant_total' => $this->montant_total,
            ]);

            // Ajout des produits dans la commande
            foreach ($this->produits as $p) {
                $commande->produits()->attach($p['produit_id'], [
                    'quantite' => $p['quantite'],
                    'prix_unitaire' => $p['prix_unitaire'],
                ]);
            }

            DB::commit();
            $this->showSuccessMessage = true;

            // Réinitialisation après soumission
            $this->reset(['client_id', 'produits', 'montant_total']);
            $this->produits = [['produit_id' => '', 'quantite' => 1, 'prix_unitaire' => 0.00]];  // Réinitialisation de la liste des produits

            $this->dispatch("reloadCommandes");

        } catch (\Exception $e) {
            DB::rollBack();
        }
        Flux::modal("create-rendezvous")->close();
    }

    // Méthode qui rend la vue
    public function render()
    {
        return view('livewire.commande-create', [
            'clients' => $this->clients, 
            'produits' => $this->produits, // Assurez-vous que cette ligne est présente
            'produitList' => $this->produitList,
        ]);
    }
    
    public function resetForm()
    {
        $this->client_id = '';
        $this->produits = '';
        $this->montant_total = '';
    }
    
}
