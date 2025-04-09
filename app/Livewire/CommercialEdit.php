<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commercial;
use Livewire\Attributes\On;
use Flux;

class CommercialEdit extends Component
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $commercialId;
    public $showSuccessMessage = false;

    public function render()
    {
        return view('livewire.commercial-edit');
    }

    #[On('editCommercial')]
    public function editCommercial($id)
    {
        $commercial = Commercial::find($id);

        $this->commercialId = $id;
        $this->nom = $commercial->nom;
        $this->email = $commercial->email;
        $this->telephone = $commercial->telephone;
        $this->adresse = $commercial->adresse;

        Flux::modal('edit-commercial')->show();
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        $commercial = Commercial::find($this->commercialId);
        $commercial->nom = $this->nom;
        $commercial->email = $this->email;
        $commercial->telephone = $this->telephone;
        $commercial->adresse = $this->adresse;
        $commercial->save();

        Flux::modal('edit-commercial')->close();
        $this->dispatch('reloadCommerciaux');

        $this->showSuccessMessage = true;
    }
}
