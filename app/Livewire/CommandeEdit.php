<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class CommandeEdit extends Component
{
    public $commandeId;
    public $client_id;
    public $produits = [];
    public $montant_total;
    public $showSuccessMessage = false;
    public $clients;
    public $produitList;

    protected $listeners = ['editCommande' => 'loadCommande'];

    public function mount()
    {
        $this->clients = Client::all();
        $this->produitList = Produit::all();
    }

    public function loadCommande($id)
    {
        $commande = Commande::with('produits')->findOrFail($id);
        $this->commandeId = $commande->id;
        $this->client_id = $commande->client_id;
        $this->montant_total = $commande->montant_total;

        $this->produits = $commande->produits->map(function ($p) {
            return [
                'produit_id' => $p->id,
                'quantite' => $p->pivot->quantite,
                'prix_unitaire' => $p->pivot->prix_unitaire,
            ];
        })->toArray();
    }

    public function updatedProduits()
    {
        foreach ($this->produits as $index => $produit) {
            if (!empty($produit['produit_id'])) {
                $p = Produit::find($produit['produit_id']);
                $this->produits[$index]['prix_unitaire'] = $p ? $p->prix : 0.00;
            }
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->montant_total = collect($this->produits)->sum(function ($p) {
            return (float) $p['prix_unitaire'] * (int) $p['quantite'];
        });
    }

    public function update()
    {
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $commande = Commande::findOrFail($this->commandeId);
            $commande->update([
                'client_id' => $this->client_id,
                'montant_total' => $this->montant_total,
            ]);

            $commande->produits()->detach();

            foreach ($this->produits as $p) {
                $commande->produits()->attach($p['produit_id'], [
                    'quantite' => $p['quantite'],
                    'prix_unitaire' => $p['prix_unitaire'],
                ]);
            }

            DB::commit();
            $this->showSuccessMessage = true;
            $this->dispatchBrowserEvent('close-modal');

            $this->emit('commandeUpdated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.commande-edit');
    }
}
