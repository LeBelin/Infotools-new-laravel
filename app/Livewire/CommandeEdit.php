<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande; // Ensure you import the Commande model
use Livewire\Attributes\On;
use Flux;

class CommandeEdit extends Component
{
    public $client_id;
    public $produit_id;
    public $quantite;
    public $montant;
    public $commandeId;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.commande-edit');
    }

    #[On('editCommande')]
    public function editCommande($id)
    {
        $commande = Commande::find($id);

        $this->commandeId = $id;
        $this->client_id = $commande->client_id;
        $this->produit_id = $commande->produit_id;
        $this->quantite = $commande->quantite;
        $this->montant = $commande->montant;

        Flux::modal('edit-commande')->show();
    }

    public function update()
    {
        $this->validate([
            'client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required',
            'montant' => 'required',
        ]);

        $commande = Commande::find($this->commandeId);
        $commande->client_id = $this->client_id;
        $commande->produit_id = $this->produit_id;
        $commande->quantite = $this->quantite;
        $commande->montant = $this->montant;
        $commande->save();

        Flux::modal('edit-commande')->close();
        $this->dispatch('reloadCommandes');

        $this->showSuccessMessage = true;
    }
}
