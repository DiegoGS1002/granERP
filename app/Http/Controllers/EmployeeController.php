<?php

namespace App\Http\Controllers;

use App\Models\Employees;

class EmployeeController extends Controller
{

    /**
     * Show printable list of employees
     */
    public function print()
    {
        $employees = Employees::all();
        return view('cadastro.funcionarios.print', compact('employees'));
    }
}
