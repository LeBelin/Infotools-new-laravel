<?php

namespace App\Livewire;
use App\Models\Produit;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;


class Produits extends Component
{

    public $produits;
    public $produitId;
    public $produitName;
    public $showSuccessMessage = false;
    
    // Affichage des clients
    public function mount()
    {
        $this->produits = Produit::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.produits');
    }

    //refresh a l'ajout d'un produit
    #[On('reloadProduits')]
    public function reloadClients()
    {
        $this->produits = Produit::orderBy('created_at', 'desc')->get();
    }

    public function edit($id)
    {
        $this->dispatch("editProduit", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $produit = Produit::find($id);
        if ($produit) {
            $this->produitId = $id;
            $this->produitName = $produit->nom_produit;
            Flux::modal('delete-produit')->show();
        }
    }

    public function destroy()
    {
        Produit::find($this->produitId)->delete();
        Flux::modal('delete-produit')->close();
        $this->reloadProduit();
        $this->showSuccessMessage = true;
    }
}
