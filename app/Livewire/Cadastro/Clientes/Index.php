<?php

namespace App\Livewire\Cadastro\Clientes;

use App\Models\Client;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Clientes')]
class Index extends Component
{
    public string $search = '';

    public function deleteClient(string $clientId): void
    {
        Client::query()->whereKey($clientId)->delete();

        session()->flash('success', 'Cliente deletado com sucesso!');
    }

    public function getClientsProperty()
    {
        return Client::query()
            ->when($this->search !== '', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', "%{$this->search}%")
                        ->orWhere('social_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('taxNumber', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.cadastro.clientes.index');
    }
}

