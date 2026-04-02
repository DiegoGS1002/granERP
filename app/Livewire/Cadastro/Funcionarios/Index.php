<?php

namespace App\Livewire\Cadastro\Funcionarios;

use App\Models\Employees;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Funcionarios')]
class Index extends Component
{
    public string $search = '';

    public function deleteEmployee(string $employeeId): void
    {
        Employees::query()->whereKey($employeeId)->delete();

        session()->flash('success', 'Funcionario deletado com sucesso!');
    }

    public function getEmployeesProperty()
    {
        return Employees::query()
            ->when($this->search !== '', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', "%{$this->search}%")
                        ->orWhere('role', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('identification_number', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.cadastro.funcionarios.index');
    }
}

