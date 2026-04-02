<?php

namespace App\Livewire\Cadastro\Fornecedores;

use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Form extends Component
{
    public ?Supplier $supplier = null;

    public string $name = '';
    public string $social_name = '';
    public string $taxNumber = '';
    public string $email = '';
    public string $phone_number = '';
    public string $address_zip_code = '';
    public string $address_street = '';
    public string $address_number = '';
    public string $address_complement = '';
    public string $address_district = '';
    public string $address_city = '';
    public string $address_state = '';

    public function mount(?Supplier $supplier = null): void
    {
        $this->supplier = $supplier && $supplier->exists ? $supplier : null;

        if ($this->supplier) {
            $this->name = $this->supplier->name;
            $this->social_name = $this->supplier->social_name;
            $this->taxNumber = $this->supplier->taxNumber;
            $this->email = $this->supplier->email;
            $this->phone_number = $this->supplier->phone_number;
            $this->address_zip_code = $this->supplier->address_zip_code;
            $this->address_street = $this->supplier->address_street;
            $this->address_number = $this->supplier->address_number;
            $this->address_complement = $this->supplier->address_complement;
            $this->address_district = $this->supplier->address_district;
            $this->address_city = $this->supplier->address_city;
            $this->address_state = $this->supplier->address_state;
        }
    }

    protected function rules(): array
    {
        $supplierId = $this->supplier?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'social_name' => ['required', 'string', 'max:255'],
            'taxNumber' => ['required', 'string', 'max:14', Rule::unique('suppliers', 'taxNumber')->ignore($supplierId)],
            'email' => ['required', 'email', Rule::unique('suppliers', 'email')->ignore($supplierId)],
            'phone_number' => ['required', 'string', 'max:255'],
            'address_zip_code' => ['required', 'string', 'max:255'],
            'address_street' => ['required', 'string', 'max:255'],
            'address_number' => ['required', 'string', 'max:255'],
            'address_complement' => ['required', 'string', 'max:255'],
            'address_district' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:255'],
            'address_state' => ['required', 'string', 'size:2'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->supplier) {
            $this->supplier->update($validated);

            return redirect()
                ->route('suppliers.index')
                ->with('success', 'Fornecedor atualizado com sucesso!');
        }

        Supplier::query()->create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function render()
    {
        $title = $this->supplier ? 'Editar Fornecedor' : 'Novo Fornecedor';

        return view('livewire.cadastro.fornecedores.form', [
            'isEditing' => (bool) $this->supplier,
        ])->title($title);
    }
}

