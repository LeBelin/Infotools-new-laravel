<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produit; // Ensure you import the Produit model
use Livewire\Attributes\On;
use Flux;

class ProduitEdit extends Component
{
    public $nom_produit;
    public $description;
    public $prix;
    public $stock;
    public $produitId;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.produit-edit');
    }

    #[On('editProduit')]
    public function editProduit($id)
    {
        $produit = Produit::find($id);

        $this->produitId = $id;
        $this->nom_produit = $produit->nom_produit;
        $this->description = $produit->description;
        $this->prix = $produit->prix;
        $this->stock = $produit->stock;

        Flux::modal('edit-produit')->show();
    }

    public function update()
    {
        $this->validate([
            'nom_produit' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'stock' => 'required',
        ]);

        $produit = Produit::find($this->produitId);
        $produit->nom_produit = $this->nom_produit;
        $produit->description = $this->description;
        $produit->prix = $this->prix;
        $produit->stock = $this->stock;
        $produit->save();

        Flux::modal('edit-produit')->close();
        $this->dispatch('reloadProduits');

        $this->showSuccessMessage = true;
    }
}
