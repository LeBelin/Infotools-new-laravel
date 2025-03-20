<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of clients
        $clientCount = Client::count();

        // Pass the client count to the view
        return view('dashboard', compact('clientCount'));
    }
}
