<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class SupplierController extends Controller
{

    /**
     * Show printable list of suppliers
     */
    public function print()
    {
        $suppliers = Supplier::all();
        return view('cadastro.fornecedores.print', compact('suppliers'));
    }
}
