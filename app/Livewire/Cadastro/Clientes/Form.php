<?php

namespace App\Livewire\Cadastro\Clientes;

use App\Models\Client;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Form extends Component
{
    public ?Client $client = null;

    public string $name = '';
    public string $social_name = '';
    public string $taxNumber = '';
    public string $email = '';
    public string $phone_number = '';
    public string $address = '';

    public function mount(?Client $client = null): void
    {
        $this->client = $client && $client->exists ? $client : null;

        if ($this->client) {
            $this->name = $this->client->name;
            $this->social_name = $this->client->social_name ?? '';
            $this->taxNumber = $this->client->taxNumber;
            $this->email = $this->client->email;
            $this->phone_number = $this->client->phone_number ?? '';
            $this->address = $this->client->address ?? '';
        }
    }

    protected function rules(): array
    {
        $clientId = $this->client?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'social_name' => ['nullable', 'string', 'max:255'],
            'taxNumber' => ['required', 'string', Rule::unique('clients', 'taxNumber')->ignore($clientId)],
            'email' => ['required', 'email', Rule::unique('clients', 'email')->ignore($clientId)],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->client) {
            $this->client->update($validated);
            $message = 'Cliente atualizado com sucesso!';
        } else {
            Client::query()->create($validated);
            $message = 'Cliente salvo com sucesso!';
        }

        return redirect()
            ->route('clients.index')
            ->with('success', $message);
    }

    public function render()
    {
        $title = $this->client ? 'Editar Cliente' : 'Novo Cliente';

        return view('livewire.cadastro.clientes.form', [
            'isEditing' => (bool) $this->client,
        ])->title($title);
    }
}





