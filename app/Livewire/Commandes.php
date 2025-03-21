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
    
    // Affichage des commandes
    public function mount()
    {
        $this->commandes = Commande::all();
    }

    public function render()
    {
        return view('livewire.commandes');
    }

    //refresh a l'ajout d'une commandes
    #[On('reloadCommandes')]
    public function reloadCommandes()
    {
        $this->commandes = Commande::all();
    }

    public function edit($id)
    {
        $this->dispatch("editCommande", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $commande = Commande::find($id);
        if ($commande) {
            $this->commandeId = $id;
            $this->commandeName = $commande->nom;
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
