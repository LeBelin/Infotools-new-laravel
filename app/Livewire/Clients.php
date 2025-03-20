<?php

namespace App\Livewire;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;


class Clients extends Component
{

    public $clients;
    public $clientId;
    public $clientName;
    public $showSuccessMessage = false;
    
    // Affichage des clients
    public function mount()
    {
        $this->clients = Client::all();
    }

    public function render()
    {
        return view('livewire.clients');
    }

    //refresh a l'ajout d'un client
    #[On('reloadClients')]
    public function reloadClients()
    {
        $this->clients = Client::all();
    }

    public function edit($id)
    {
        $this->dispatch("editClient", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $client = Client::find($id);
        if ($client) {
            $this->clientId = $id;
            $this->clientName = $client->nom;
            Flux::modal('delete-client')->show();
        }
    }

    public function destroy()
    {
        Client::find($this->clientId)->delete();
        Flux::modal('delete-client')->close();
        $this->reloadClients();
        $this->showSuccessMessage = true;
    }
}
