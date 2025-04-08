<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prospect; // Ensure you import the Client model
use Livewire\Attributes\On;
use Flux;

class ProspectEdit extends Component
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $clientId;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.prospect-edit');
    }

    #[On('editProspect')]
    public function editProspect($id)
    {
        $prospect = Prospect::find($id);

        $this->prospectId = $id;
        $this->nom = $prospect->nom;
        $this->email = $prospect->email;
        $this->telephone = $prospect->telephone;
        $this->adresse = $prospect->adresse;

        Flux::modal('edit-prospect')->show();
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        $prospect = Prospect::find($this->prospectId);
        $prospect->nom = $this->nom;
        $prospect->email = $this->email;
        $prospect->telephone = $this->telephone;
        $prospect->adresse = $this->adresse;
        $prospect->save();

        Flux::modal('edit-prospect')->close();
        $this->dispatch('reloadProspects');

        $this->showSuccessMessage = true;
    }
}
