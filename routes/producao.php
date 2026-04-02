<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Overview;
use App\Livewire\Dashboard\KpiReport;
use App\Http\Controllers\ProductionOrdersController;

Route::get('/dashboard', Overview::class)->name('dashboard.index');
Route::get('/dashboard/kpi', KpiReport::class)->name('dashboard.kpi');
Route::resource('production_orders', ProductionOrdersController::class);
