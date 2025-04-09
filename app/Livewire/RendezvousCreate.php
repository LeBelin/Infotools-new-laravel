<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rendezvous;
use App\Models\Client;
use Flux;

class RendezvousCreate extends Component
{
    public $clients;
    public $client_id;
    public $date_rendez_vous;
    public $heure_rendez_vous;
    public $description;
    public $showSuccessMessage = false;

    public function mount()
    {
        // Charge les clients
        $this->clients = Client::all();
    }

    public function render()
    {
        return view('livewire.rendezvous-create');
    }

    public function submit()
    {
        $this->validate([
            'client_id' => 'required',
            'date_rendez_vous' => 'required',
            'heure_rendez_vous' => 'required',
            'description' => 'required',
        ]);

        Rendezvous::create([
            'client_id' => $this->client_id,
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
        $this->date_rendez_vous = '';
        $this->heure_rendez_vous = '';
        $this->description = '';
    }
}
