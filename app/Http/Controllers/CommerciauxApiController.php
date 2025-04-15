<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commercial;


class CommerciauxApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commerciaux = Commerciaux::all();
        return response()->json([
            "success" => true,
            "message" => "Liste des commerciaux",
            "data" => $commerciaux
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomCommerciaux'=>'required',
            'prenomCommerciaux'=>'required',
            'adresseCommerciaux'=>'required',
            'villeCommerciaux'=>'required',
            'cpCommerciaux'=>'required',
            'mailCommerciaux'=>'required',
            'telCommerciaux'=>'required',
        ]);

        $commerciaux = Commerciaux::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Commercial crée avec succès.",
            "data" => $commerciaux
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commerciaux = Commerciaux::find($id);

        if (is_null($commerciaux)) {
            return $this->sendError('Commercial non trouvé.');
        }

        return response()->json([
            "success" => true,
            "message" => "Commercial trouvé avec succès.",
            "data" => $commerciaux
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomCommerciaux'=>'required',
            'prenomCommerciaux'=>'required',
            'adresseCommerciaux'=>'required',
            'villeCommerciaux'=>'required',
            'cpCommerciaux'=>'required',
            'mailCommerciaux'=>'required',
            'telCommerciaux'=>'required',
        ]);

        $input = $request->all();
        $commerciaux->idCommerciaux = $input['idCommerciaux'];
        $commerciaux->nomCommerciaux = $input['nomCommerciaux'];
        $commerciaux->prenomCommerciaux = $input['prenomCommerciaux'];
        $commerciaux->adresseCommerciaux = $input['adresseCommerciaux'];
        $commerciaux->villeCommerciaux = $input['villeCommerciaux'];
        $commerciaux->cpCommerciaux = $input['cpCommerciaux'];
        $commerciaux->mailCommerciaux = $input['mailCommerciaux'];
        $commerciaux->telCommerciaux = $input['telCommerciaux'];
        $commerciaux->save();

        return response()->json([
            "success" => true,
            "message" => "commercial mis à jour avec succès.",
            "data" => $commerciaux
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Commerciaux::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "Commercial supprimé avec succès.",
        ]);
    }
}
