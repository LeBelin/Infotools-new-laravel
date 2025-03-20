<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client; // Ensure you import the Client model
use Livewire\Attributes\On;
use Flux;

class ClientEdit extends Component
{
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $clientId;

    public function render()
    {
        return view('livewire.client-edit');
    }

    #[On('editClient')]
    public function editClient($id)
    {
        $client = Client::find($id);

        $this->clientId = $id;
        $this->nom = $client->nom;
        $this->email = $client->email;
        $this->telephone = $client->telephone;
        $this->adresse = $client->adresse;

        Flux::modal('edit-client')->show();
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        $client = Client::find($this->clientId);
        $client->nom = $this->nom;
        $client->email = $this->email;
        $client->telephone = $this->telephone;
        $client->adresse = $this->adresse;
        $client->save();

        Flux::modal('edit-client')->close();
        $this->dispatch('reloadClients');
    }
}
