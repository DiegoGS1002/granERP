<?php

use App\Livewire\Cadastro\Funcionarios\Form as EmployeeForm;
use App\Livewire\Cadastro\Funcionarios\Index as EmployeeIndex;
use App\Models\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates an employee through livewire form', function () {
    Livewire::test(EmployeeForm::class)
        ->set('name', 'Funcionario Teste')
        ->set('identification_number', '12345678901')
        ->set('role', 'Analista')
        ->set('email', 'funcionario@example.com')
        ->set('phone_number', '11999999999')
        ->set('address', 'Rua Exemplo, 10')
        ->call('save')
        ->assertRedirect(route('employees.index'));

    $this->assertDatabaseHas('employees', [
        'name' => 'Funcionario Teste',
        'email' => 'funcionario@example.com',
    ]);
});

it('updates an employee through livewire form', function () {
    $employee = Employees::query()->create([
        'name' => 'Funcionario Antigo',
        'identification_number' => '11111111111',
        'role' => 'Assistente',
        'email' => 'antigo-funcionario@example.com',
        'phone_number' => '11888888888',
        'address' => 'Endereco antigo',
    ]);

    Livewire::test(EmployeeForm::class, ['employee' => $employee])
        ->set('name', 'Funcionario Novo')
        ->set('identification_number', '22222222222')
        ->set('role', 'Coordenador')
        ->set('email', 'novo-funcionario@example.com')
        ->set('phone_number', '11777777777')
        ->set('address', 'Endereco novo')
        ->call('save')
        ->assertRedirect(route('employees.index'));

    $this->assertDatabaseHas('employees', [
        'id' => $employee->id,
        'name' => 'Funcionario Novo',
        'email' => 'novo-funcionario@example.com',
    ]);
});

it('deletes an employee from livewire index', function () {
    $employee = Employees::query()->create([
        'name' => 'Funcionario Delete',
        'identification_number' => '33333333333',
        'role' => 'Auxiliar',
        'email' => 'delete-funcionario@example.com',
        'phone_number' => '11666666666',
        'address' => 'Endereco delete',
    ]);

    Livewire::test(EmployeeIndex::class)
        ->call('deleteEmployee', $employee->id);

    $this->assertDatabaseMissing('employees', [
        'id' => $employee->id,
    ]);
});

