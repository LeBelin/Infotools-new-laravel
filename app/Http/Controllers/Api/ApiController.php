<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // register API
    // public function register(Request $request) {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|confirmed',
    //     ]);

    //     User::create($request->all());

    //     return response()->json([
    //         "status" => "success",
    //         "message" => "Utilisateur enregistrer avec succée",
    //     ]);        
    // }

    // login API
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // verification de l'utilisateur par son email
        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {
            // verification du mots de passe
            if ($user) {

                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createtoken("myToken")->plainTextToken;

                    return response()->json([
                        "status" => true,
                        "message" => "Connection réussie",
                        "token" => $token
                    ]);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "Le mots de passe n'est pas bon"
                    ]);
                }
            } else {
                    return response()->json([
                        "status" => false,
                        "message" => "L'email est invalide"
                    ]);
            }
        }
    }

    // rendezvous API
    public function rendezvous() {
        
    }

    // logout API
    public function logout() {

    }
}
