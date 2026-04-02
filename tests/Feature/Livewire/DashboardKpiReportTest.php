<?php

use App\Livewire\Dashboard\KpiReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders dashboard kpi route', function () {
    $response = $this->get(route('dashboard.kpi'));

    $response->assertOk();
    $response->assertSee('Indicadores KPI');
});

it('loads kpi report payload', function () {
    Livewire::test(KpiReport::class)
        ->assertSet('faturamento', fn (array $value) => count($value) > 0)
        ->assertSet('categorias', fn (array $value) => count($value) > 0)
        ->assertSet('distribuicao', fn (array $value) => count($value) > 0)
        ->assertSet('tableRows', fn (array $value) => count($value) > 0);
});

it('filters table by month event', function () {
    Livewire::test(KpiReport::class)
        ->call('filtrarMes', 0)
        ->assertSet('selectedMonth', 0)
        ->assertViewHas('rows', fn (array $rows) => count($rows) <= 1);
});

