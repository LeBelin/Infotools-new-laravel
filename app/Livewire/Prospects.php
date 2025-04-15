<?php

namespace App\Livewire;
use App\Models\Prospect;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;


class Prospects extends Component
{

    public $prospects;
    public $prospectId;
    public $prospectName;
    public $showSuccessMessage = false;
    
    // Affichage des prospects
    public function mount()
    {
        $this->prospects = Prospect::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.prospects');
    }

    //refresh a l'ajout d'un prospect
    #[On('reloadProspects')]
    public function reloadProspects()
    {
        $this->prospects = Prospect::orderBy('created_at', 'desc')->get();
    }

    public function edit($id)
    {
        $this->dispatch("editProspect", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $prospect = Prospect::find($id);
        if ($prospect) {
            $this->prospectId = $id;
            $this->prospectName = $prospect->nom;
            Flux::modal('delete-prospect')->show();
        }
    }

    public function destroy()
    {
        Prospect::find($this->prospectId)->delete();
        Flux::modal('delete-prospect')->close();
        $this->reloadProspects();
        $this->showSuccessMessage = true;
    }
}
