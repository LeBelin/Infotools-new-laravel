<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commercial;
use Flux;

class CommercialCreate extends Component
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.commercial-create');
    }

    public function submit()
    {
        $this->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        Commercial::create([
            'nom' => $this->nom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
        ]);

        $this->showSuccessMessage = true;
        $this->resetForm();

        Flux::modal("create-commercial")->close();

        $this->dispatch("reloadCommerciaux");
    }

    public function resetForm()
    {
        $this->nom = '';
        $this->email = '';
        $this->telephone = '';
        $this->adresse = '';
    }
}
