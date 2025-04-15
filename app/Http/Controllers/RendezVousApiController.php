<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;

class RendezVousApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rendezvous = RendezVous::all();
        return response()->json([
            "success" => true,
            "message" => "Liste des rendez-vous",
            "data" => $rendezvous
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dateRendezVous'=>'required',
            'descriptionRendezVous'=>'required',
            'heureDebutRendezVous'=>'required',
            'heureFinRendezVous'=>'required',
            'idCommerciaux'=>'required',
            'idProspect'=>'required',
            'idClient'=>'required',
        ]);

        $rendezvous = RendezVous::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Rendez-vous crée avec succès.",
            "data" => $rendezvous
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rendezvous = RendezVous::find($id);

        if (is_null($rendezvous)) {
            return $this->sendError('Rendez-vous non trouvé.');
        }

        return response()->json([
            "success" => true,
            "message" => "Rendez-vous trouvé avec succès.",
            "data" => $rendezvous
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dateRendezVous'=>'required',
            'descriptionRendezVous'=>'required',
            'heureDebutRendezVous'=>'required',
            'heureFinRendezVous'=>'required',
            'idCommerciaux'=>'required',
            'idProspect'=>'required',
            'idClient'=>'required',
        ]);

        $input = $request->all();
        $rendezvous->idRendezVous = $input['idRendezVous'];
        $rendezvous->dateRendezVous = $input['dateRendezVous'];
        $rendezvous->descriptionRendezVous = $input['descriptionRendezVous'];
        $rendezvous->heureDebutRendezVous = $input['heureDebutRendezVous'];
        $rendezvous->heureFinRendezVous = $input['heureFinRendezVous'];
        $rendezvous->dateCreation = $input['dateCreation'];
        $rendezvous->idCommerciaux = $input['idCommerciaux'];
        $rendezvous->idProspect = $input['idProspect'];
        $rendezvous->idClient = $input['idClient'];
        $rendezvous->save();

        return response()->json([
            "success" => true,
            "message" => "Rendez-vous mis à jour avec succès.",
            "data" => $rendezvous
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RendezVous::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "Rendez-vous supprimé avec succès.",
        ]);
    }
}
