<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prospect; // Ensure you import the Client model
use Flux;

class ProspectCreate extends Component
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.prospect-create');
    }

    public function submit()
    {
        $this->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        Prospect::create([
            'nom' => $this->nom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
        ]);

        $this->showSuccessMessage = true;
        $this->resetForm();

        Flux::modal("create-prospect")->close();

        $this->dispatch("reloadProspects");
    }

    public function resetForm()
    {
        $this->nom = '';
        $this->email = '';
        $this->telephone = '';
        $this->adresse = '';
    }
}
