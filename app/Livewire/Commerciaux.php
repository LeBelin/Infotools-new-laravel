<?php

namespace App\Livewire;
use App\Models\Commercial;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;


class Commerciaux extends Component
{

    public $commerciaux;
    public $commercialId;
    public $commercialName;
    public $showCommercial;
    public $showSuccessMessage = false;
    
    // Affichage des commerciaux
    public function mount()
    {
        $this->commerciaux = Commercial::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.commerciaux');
    }

    public function show($id)
    {
        $commercial = Commercial::find($id);
        if ($commercial) {
            $this->showCommercial = $commercial;
            Flux::modal('show-commercial')->show();
        }
    }

    //refresh a l'ajout d'un commercial
    #[On('reloadCommerciaux')]
    public function reloadCommerciaux()
    {
        $this->commerciaux = Commercial::orderBy('created_at', 'desc')->get();
    }

    public function edit($id)
    {
        $this->dispatch("editCommercial", $id);
    }

    public function delete($id)
    {
        //de base
       // $this->clientId = $id;
        //Flux::modal('delete-client')->show();

        // ia
        $commercial = Commercial::find($id);
        if ($commercial) {
            $this->commercialId = $id;
            $this->commercialName = $commercial->nom;
            Flux::modal('delete-commercial')->show();
        }
    }

    public function destroy()
    {
        Commercial::find($this->commercialId)->delete();
        Flux::modal('delete-commercial')->close();
        $this->reloadCommerciaux();
        $this->showSuccessMessage = true;
    }
}
