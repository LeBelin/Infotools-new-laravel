<?php

namespace App\Livewire;
use App\Models\Rendezvous;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;


class Rendezvouss extends Component
{

    public $rendezvous;
    public $rendezvousId;
    public $rendezvousName;
    public $showSuccessMessage = false;

    public function mount()
    {
        // Vérifie que la variable $rendezvous est bien chargée
        $this->rendezvous = Rendezvous::all();  // Charge tous les rendez-vous
    }

    public function render()
    {
        return view('livewire.rendezvous');
    }

    //refresh a l'ajout d'une rendezvous
    #[On('reloadRendezvous')]
    public function reloadRendezvous()
    {
        $this->rendezvous = Rendezvous::all();
    }

    public function edit($id)
    {
        $this->dispatch("editRendezvous", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $rendezvous = Rendezvous::find($id);
        if ($rendezvous) {
            $this->rendezvousId = $id;
            $this->rendezvousName = $rendezvous->nom;
            Flux::modal('delete-rendezvous')->show();
        }
    }

    public function destroy()
    {
        Rendezvous::find($this->rendezvousId)->delete();
        Flux::modal('delete-rendezvous')->close();
        $this->reloadRendezvous();
        $this->showSuccessMessage = true;
    }
}
