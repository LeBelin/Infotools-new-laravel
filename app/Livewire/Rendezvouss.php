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
    public $showRendezvous;
    public $showSuccessMessage = false;

    public function mount()
    {
        $this->rendezvous = Rendezvous::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.rendezvous');
    }

    public function show($id)
    {
        $rendezvous = Rendezvous::find($id);
        if ($rendezvous) {
            $this->showRendezvous = $rendezvous;
            Flux::modal('show-rendezvous')->show();
        }
    }

    //refresh a l'ajout d'une rendezvous
    #[On('reloadRendezvous')]
    public function reloadRendezvous()
    {
        $this->rendezvous = Rendezvous::orderBy('created_at', 'desc')->get();
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
