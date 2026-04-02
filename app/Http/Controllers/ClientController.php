<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientController extends Controller
{

    /**
     * Show printable list of clients
     */
    public function print()
    {
        $clients = Client::all();
        return view('cadastro.clientes.print', compact('clients'));
    }
}
