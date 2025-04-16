<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rendezvous;
use App\Models\Client;
use Livewire\Attributes\On;
use App\Models\Commercial;
use Flux;

class RendezvousEdit extends Component
{
    public $clients;
    public $client_id;
    public $commerciaux;
    public $commercial_id;
    public $date_rendez_vous;
    public $heure_rendez_vous;
    public $description;
    public $rendezvousId;
    public $showSuccessMessage = false;

    public function mount()
    {
        // Charge les clients et commerciaux au démarrage du composant
        $this->clients = Client::all();
        $this->commerciaux = Commercial::all(); 
    }

    public function render()
    {
        return view('livewire.rendezvous-edit');
    }

    #[On('editRendezvous')]
    public function editRendezvous($id)
    {
        $rendezvous = Rendezvous::find($id);

        $this->rendezvousId = $id;
        $this->client_id = $rendezvous->client_id;
        $this->commercial_id = $rendezvous->commercial_id;
        $this->date_rendez_vous = $rendezvous->date_rendez_vous;
        $this->heure_rendez_vous = $rendezvous->heure_rendez_vous;
        $this->description = $rendezvous->description;

        Flux::modal('edit-rendezvous')->show();
    }

    public function update()
    {
        $this->validate([
            'client_id' => 'required',
            'commercial_id' => 'required',
            'date_rendez_vous' => 'required',
            'heure_rendez_vous' => 'required',
            'description' => 'required',
        ]);

        $rendezvous = Rendezvous::find($this->rendezvousId);
        $rendezvous->client_id = $this->client_id;
        $rendezvous->commercial_id = $this->commercial_id;
        $rendezvous->date_rendez_vous = $this->date_rendez_vous;
        $rendezvous->heure_rendez_vous = $this->heure_rendez_vous;
        $rendezvous->description = $this->description;
        $rendezvous->save();

        Flux::modal('edit-rendezvous')->close();
        $this->dispatch('reloadRendezvous');

        $this->showSuccessMessage = true;
    }
}
