<?php

namespace App\Livewire\Cadastro\Funcionarios;

use App\Models\Employees;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Form extends Component
{
    public ?Employees $employee = null;

    public string $name = '';
    public string $identification_number = '';
    public string $role = '';
    public string $email = '';
    public string $phone_number = '';
    public string $address = '';

    public function mount(?Employees $employee = null): void
    {
        $this->employee = $employee && $employee->exists ? $employee : null;

        if ($this->employee) {
            $this->name = $this->employee->name;
            $this->identification_number = $this->employee->identification_number;
            $this->role = $this->employee->role;
            $this->email = $this->employee->email;
            $this->phone_number = $this->employee->phone_number;
            $this->address = $this->employee->address;
        }
    }

    protected function rules(): array
    {
        $employeeId = $this->employee?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'identification_number' => ['required', 'string', 'max:11', Rule::unique('employees', 'identification_number')->ignore($employeeId)],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($employeeId)],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->employee) {
            $this->employee->update($validated);

            return redirect()
                ->route('employees.index')
                ->with('success', 'Funcionario atualizado com sucesso!');
        }

        Employees::query()->create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Funcionario salvo com sucesso!');
    }

    public function render()
    {
        $title = $this->employee ? 'Editar Funcionario' : 'Novo Funcionario';

        return view('livewire.cadastro.funcionarios.form', [
            'isEditing' => (bool) $this->employee,
        ])->title($title);
    }
}

