<?php

namespace App\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;

class Commandes extends Component
{
    public $commandes;
    public $commandeId;
    public $commandeName;
    public $showSuccessMessage = false;

    public function mount()
    {
        $this->commandes = Commande::with(['client', 'produits'])->get();
    }

    public function render()
    {
        return view('livewire.commandes');
    }

    #[On('reloadCommandes')]
    public function reloadCommandes()
    {
        $this->commandes = Commande::with(['client', 'produits'])->get();
    }

    public function edit($id)
    {
        $this->dispatch("editCommande", $id);
    }

    public function delete($id)
    {
        $commande = Commande::find($id);
        if ($commande) {
            $this->commandeId = $id;
            $this->commandeName = 'Commande #' . $commande->id;
            Flux::modal('delete-commande')->show();
        }
    }

    public function destroy()
    {
        Commande::find($this->commandeId)->delete();
        Flux::modal('delete-commande')->close();
        $this->reloadCommandes();
        $this->showSuccessMessage = true;
    }
}

