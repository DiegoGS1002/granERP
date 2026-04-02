<?php

namespace App\Livewire\Cadastro\Fornecedores;

use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Fornecedores')]
class Index extends Component
{
    public string $search = '';

    public function deleteSupplier(string $supplierId): void
    {
        Supplier::query()->whereKey($supplierId)->delete();

        session()->flash('success', 'Fornecedor deletado com sucesso!');
    }

    public function getSuppliersProperty()
    {
        return Supplier::query()
            ->when($this->search !== '', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', "%{$this->search}%")
                        ->orWhere('social_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('taxNumber', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('social_name')
            ->get();
    }

    public function render()
    {
        return view('livewire.cadastro.fornecedores.index');
    }
}

