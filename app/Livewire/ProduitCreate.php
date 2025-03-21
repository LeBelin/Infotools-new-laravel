<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produit; // Ensure you import the Produit model
use Flux;

class ProduitCreate extends Component
{
    public $nom_produit;
    public $description;
    public $prix;
    public $stock;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.produit-create');
    }

    public function submit()
    {
        $this->validate([
            'nom_produit' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'stock' => 'required',
        ]);

        Produit::create([
            'nom_produit' => $this->nom_produit,
            'description' => $this->description,
            'prix' => $this->prix,
            'stock' => $this->stock,
        ]);

        $this->showSuccessMessage = true;
        $this->resetForm();

        Flux::modal("create-produit")->close();

        $this->dispatch("reloadProduits");
    }

    public function resetForm()
    {
        $this->nom_produit = '';
        $this->description = '';
        $this->prix = '';
        $this->stock = '';
    }
}
