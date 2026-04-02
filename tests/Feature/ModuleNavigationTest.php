<?php

use App\Http\Controllers\ModulePageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

it('renders module page for cadastro', function () {
    $response = $this->get(route('module.show', 'cadastro'));

    $response->assertOk();
    $response->assertSee('Cadastro');
});

it('redirects to real page when module item route exists', function () {
    $response = $this->get(route('module.item.development', [
        'module' => 'cadastro',
        'item' => 'clientes',
    ]));

    $response->assertRedirect(route('clients.index'));
});

it('redirects dashboard kpi item to live route', function () {
    $response = $this->get(route('module.item.development', [
        'module' => 'dashboard',
        'item' => 'indicadores-kpi',
    ]));

    $response->assertRedirect(route('dashboard.kpi'));
});

it('shows development page when module item route does not exist', function () {
    $missing = collect(ModulePageController::allModules())
        ->map(function (array $module) {
            $missingItem = collect($module['items'])
                ->first(fn (array $item) => ! Route::has($item['route'] ?? ''));

            if (! $missingItem) {
                return null;
            }

            return [
                'module' => $module['slug'],
                'item' => Str::slug($missingItem['title']),
                'title' => $missingItem['title'],
            ];
        })
        ->first();

    if (! $missing) {
        $this->markTestSkipped('No unavailable module feature found in current route map.');
    }

    $response = $this->get(route('module.item.development', [
        'module' => $missing['module'],
        'item' => $missing['item'],
    ]));

    $response->assertOk();
    $response->assertSee('Funcionalidade em Desenvolvimento');
    $response->assertSee($missing['title']);
});
