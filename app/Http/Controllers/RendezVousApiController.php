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
        return RendezVous::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'commercial_id' => 'required',
            'date_rendez_vous' => 'required|date',
            'heure_rendez_vous' => 'required',
            'description' => 'required|string',
        ]);

        $rendezvous = RendezVous::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Rendez-vous créé avec succès.",
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
        'client_id' => 'required',
        'commercial_id' => 'required',
        'date_rendez_vous' => 'required',
        'heure_rendez_vous' => 'required',
        'description' => 'required',
    ]);

    $rendezvous = RendezVous::find($id);

    if (!$rendezvous) {
        return response()->json([
            'success' => false,
            'message' => 'Rendez-vous non trouvé.',
        ], 404);
    }

    $rendezvous->client_id = $request->client_id;
    $rendezvous->commercial_id = $request->commercial_id;
    $rendezvous->date_rendez_vous = $request->date_rendez_vous;
    $rendezvous->heure_rendez_vous = $request->heure_rendez_vous;
    $rendezvous->description = $request->description;
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
