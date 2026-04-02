<?php

use App\Livewire\Dashboard\Overview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders dashboard overview route', function () {
    $response = $this->get(route('dashboard.index'));

    $response->assertOk();
    $response->assertSee('Dashboard - Visao Geral');
});

it('loads overview component with kpis', function () {
    Livewire::test(Overview::class)
        ->assertSet('kpis', fn (array $kpis) =>
            array_key_exists('faturamento', $kpis)
            && array_key_exists('produtos', $kpis)
            && array_key_exists('pedidos', $kpis)
            && array_key_exists('despesas', $kpis)
        );
});

