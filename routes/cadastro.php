<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Cadastro\Clientes\Form as ClientForm;
use App\Livewire\Cadastro\Clientes\Index as ClientIndex;
use App\Livewire\Cadastro\Funcionarios\Form as EmployeeForm;
use App\Livewire\Cadastro\Funcionarios\Index as EmployeeIndex;
use App\Livewire\Cadastro\Fornecedores\Form as SupplierForm;
use App\Livewire\Cadastro\Fornecedores\Index as SupplierIndex;
use App\Livewire\Cadastro\Produtos\Form as ProductForm;
use App\Livewire\Cadastro\Produtos\Index as ProductIndex;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProductSupplierController;

/*
|--------------------------------------------------------------------------
| PRINT
|--------------------------------------------------------------------------
*/

Route::get('/clients/print', [ClientController::class, 'print'])->name('clients.print');
Route::get('/products/print', [ProductController::class, 'print'])->name('products.print');
Route::get('/suppliers/print', [SupplierController::class, 'print'])->name('suppliers.print');
Route::get('/employees/print', [
    App\Http\Controllers\EmployeeController::class,
    'print'
])->name('employees.print');
Route::get('/vehicles/print', [
    App\Http\Controllers\VehicleController::class,
    'print'
])->name('vehicles.print');


/*
|--------------------------------------------------------------------------
| RESOURCES
|--------------------------------------------------------------------------
*/

Route::get('/clients', ClientIndex::class)->name('clients.index');
Route::get('/clients/create', ClientForm::class)->name('clients.create');
Route::get('/clients/{client}/edit', ClientForm::class)->name('clients.edit');
Route::get('/products', ProductIndex::class)->name('products.index');
Route::get('/products/create', ProductForm::class)->name('products.create');
Route::get('/products/{product}/edit', ProductForm::class)->name('products.edit');
Route::get('/suppliers', SupplierIndex::class)->name('suppliers.index');
Route::get('/suppliers/create', SupplierForm::class)->name('suppliers.create');
Route::get('/suppliers/{supplier}/edit', SupplierForm::class)->name('suppliers.edit');
Route::get('/employees', EmployeeIndex::class)->name('employees.index');
Route::get('/employees/create', EmployeeForm::class)->name('employees.create');
Route::get('/employees/{employee}/edit', EmployeeForm::class)->name('employees.edit');
Route::resource('role', RoleController::class);
Route::resource('vehicles', VehicleController::class);


/*
|--------------------------------------------------------------------------
| PRODUCT SUPPLIERS
|--------------------------------------------------------------------------
*/

Route::get('/products/{product}/suppliers', [ProductSupplierController::class, 'index'])->name('products.suppliers.index');
Route::post('/products/{product}/suppliers', [ProductSupplierController::class, 'store'])->name('products.suppliers.store');
Route::delete('/products/{product}/suppliers/{supplier}', [ProductSupplierController::class, 'destroy'])->name('products.suppliers.destroy');
