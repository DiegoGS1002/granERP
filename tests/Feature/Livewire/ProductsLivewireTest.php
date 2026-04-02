<?php

use App\Livewire\Cadastro\Produtos\Form as ProductForm;
use App\Livewire\Cadastro\Produtos\Index as ProductIndex;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a product through livewire form', function () {
    Livewire::test(ProductForm::class)
        ->set('name', 'Produto Teste')
        ->set('ean', '7891234567890')
        ->set('description', 'Descricao do produto')
        ->set('unit_of_measure', 'unidade')
        ->set('sale_price', '10.90')
        ->set('stock', '12')
        ->set('category', 'outro')
        ->call('save');

    $product = Product::query()->first();

    expect($product)->not->toBeNull();

    $this->assertDatabaseHas('products', [
        'name' => 'Produto Teste',
        'ean' => '7891234567890',
    ]);
});

it('updates an existing product through livewire form', function () {
    $product = Product::query()->create([
        'name' => 'Produto Antigo',
        'ean' => '7891234567891',
        'description' => 'Descricao antiga',
        'unit_of_measure' => 'kg',
        'sale_price' => 20.00,
        'stock' => 5,
        'category' => 'alimentos',
    ]);

    Livewire::test(ProductForm::class, ['product' => $product])
        ->set('name', 'Produto Novo')
        ->set('ean', '7891234567892')
        ->set('description', 'Descricao nova')
        ->set('unit_of_measure', 'unidade')
        ->set('sale_price', '25.50')
        ->set('stock', '7')
        ->set('category', 'outro')
        ->call('save')
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Produto Novo',
        'ean' => '7891234567892',
    ]);
});

it('deletes a product from livewire index', function () {
    $product = Product::query()->create([
        'name' => 'Produto Delete',
        'ean' => '7891234567893',
        'description' => 'Descricao delete',
        'unit_of_measure' => 'unidade',
        'sale_price' => 5.00,
        'stock' => 1,
        'category' => 'outro',
    ]);

    Livewire::test(ProductIndex::class)
        ->call('deleteProduct', $product->id);

    $this->assertSoftDeleted('products', [
        'id' => $product->id,
    ]);
});

