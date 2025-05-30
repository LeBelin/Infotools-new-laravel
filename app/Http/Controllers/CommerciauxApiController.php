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
        $commercial = Commercial::all();
        return Commercial::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commercial = Commercial::find($id);

        if (is_null($commercial)) {
            return $this->sendError('Commercial non trouvé.');
        }

        return response()->json([
            "success" => true,
            "message" => "Commercial trouvé avec succès.",
            "data" => $commercial
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
