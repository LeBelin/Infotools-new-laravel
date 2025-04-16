<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rendezvous;
use App\Models\Client;
use App\Models\Commercial;
use Flux;

class RendezvousCreate extends Component
{
    public $clients;
    public $client_id;
    public $commerciaux;
    public $commercial_id;
    public $date_rendez_vous;
    public $heure_rendez_vous;
    public $description;
    public $showSuccessMessage = false;

    public function mount()
    {
        // Charge les clients et commerciaux au démarrage du composant
        $this->clients = Client::all();
        $this->commerciaux = Commercial::all(); 
    }

    public function render()
    {
        return view('livewire.rendezvous-create');
    }

    public function submit()
    {
        $this->validate([
            'client_id' => 'required',
            'commercial_id' => 'required',
            'date_rendez_vous' => 'required',
            'heure_rendez_vous' => 'required',
            'description' => 'required',
        ]);

        Rendezvous::create([
            'client_id' => $this->client_id,
            'commercial_id' => $this->commercial_id,
            'date_rendez_vous' => $this->date_rendez_vous,
            'heure_rendez_vous' => $this->heure_rendez_vous,
            'description' => $this->description,
        ]);

        $this->showSuccessMessage = true;
        $this->resetForm();

        Flux::modal("create-rendezvous")->close();

        $this->dispatch("reloadRendezvous");
    }

    public function resetForm()
    {
        $this->client_id = '';
        $this->commercial_id = '';
        $this->date_rendez_vous = '';
        $this->heure_rendez_vous = '';
        $this->description = '';
    }
}
