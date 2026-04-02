<?php

namespace App\Livewire\Cadastro\Produtos;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    public ?Product $product = null;

    public string $name = '';
    public string $ean = '';
    public string $description = '';
    public string $unit_of_measure = '';
    public string $sale_price = '';
    public string $stock = '';
    public string $expiration_date = '';
    public string $category = '';
    public ?TemporaryUploadedFile $image = null;

    /** @var array<int, string> */
    public array $supplier_ids = [];

    public function mount(?Product $product = null): void
    {
        $this->product = $product && $product->exists ? $product->load('suppliers') : null;

        if ($this->product) {
            $this->name = $this->product->name;
            $this->ean = $this->product->ean;
            $this->description = $this->product->description;
            $this->unit_of_measure = $this->product->unit_of_measure;
            $this->sale_price = (string) $this->product->sale_price;
            $this->stock = (string) $this->product->stock;
            $this->expiration_date = $this->product->expiration_date?->format('Y-m-d') ?? '';
            $this->category = $this->product->category;
            $this->supplier_ids = $this->product->suppliers->pluck('id')->all();
        }
    }

    protected function rules(): array
    {
        $productId = $this->product?->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('products', 'name')->ignore($productId)],
            'ean' => ['required', 'string', 'size:13', Rule::unique('products', 'ean')->ignore($productId)],
            'description' => ['required', 'string', 'max:255'],
            'unit_of_measure' => ['required', 'string'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'expiration_date' => ['nullable', 'date'],
            'category' => ['required', 'string'],
            'supplier_ids' => ['array'],
            'supplier_ids.*' => ['string', 'exists:suppliers,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $payload = [
            'name' => $validated['name'],
            'ean' => $validated['ean'],
            'description' => $validated['description'],
            'unit_of_measure' => $validated['unit_of_measure'],
            'sale_price' => $validated['sale_price'],
            'stock' => $validated['stock'],
            'expiration_date' => $validated['expiration_date'] ?: null,
            'category' => $validated['category'],
        ];

        if ($this->product) {
            $this->product->update($payload);

            if ($this->image) {
                if ($this->product->image) {
                    Storage::disk('public')->delete($this->product->image);
                }

                $this->product->update([
                    'image' => $this->image->store('products', 'public'),
                ]);
            }

            $this->product->suppliers()->sync($validated['supplier_ids'] ?? []);

            return redirect()
                ->route('products.index')
                ->with('success', 'Produto atualizado com sucesso!');
        }

        if ($this->image) {
            $payload['image'] = $this->image->store('products', 'public');
        }

        $product = Product::query()->create($payload);
        $product->suppliers()->sync($validated['supplier_ids'] ?? []);

        return redirect()
            ->route('products.suppliers.index', $product->id)
            ->with('success', 'Produto cadastrado. Agora vincule um fornecedor.');
    }

    public function render()
    {
        $title = $this->product ? 'Editar Produto' : 'Novo Produto';

        return view('livewire.cadastro.produtos.form', [
            'isEditing' => (bool) $this->product,
            'suppliers' => Supplier::query()->orderBy('social_name')->get(),
        ])->title($title);
    }
}


