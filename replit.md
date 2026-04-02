# Nexora EMS ERP

Sistema ERP modular em Laravel 12 com painel administrativo em Filament 4.5.

## Visão Geral

O projeto organiza funcionalidades por domínio de negócio (cadastro, produção, vendas, compras, fiscal, financeiro, RH, logística, estoque, perfil e administração). A página inicial (`/`) exibe os módulos e as funcionalidades ainda não concluídas mostram a tela "Em Breve" via middleware `MaintenanceERP`.

## Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Admin Panel**: Filament 4.5 (`/admin`)
- **Frontend**: Blade + Vite 7 + Tailwind CSS 4 + Bootstrap 5
- **Testes**: Pest 3
- **Banco de dados**: configurável por `DB_*` no `.env` (em `.env.example`, padrão atual: MySQL)

## Estrutura Essencial

```text
app/
  Http/Controllers/
    Api/
  Http/Middleware/        # MaintenanceERP
  Livewire/Cadastro/      # Telas de cadastro com Livewire
  Models/
  Providers/Filament/     # AdminPanelProvider
routes/
  web.php                 # Inclui os módulos web
  api.php                 # Endpoints REST
  cadastro.php
  administracao.php
  compras.php
  producao.php
  vendas.php
  fiscal.php
  financeiro.php
  rh.php
  logistica.php
  estoque.php
  perfil.php
```

## Setup e Execução

Use os scripts oficiais do `composer.json`:

```bash
composer run setup
composer run dev
```

O `setup` instala dependências, cria `.env` quando necessário, gera `APP_KEY`, executa migrações (`php artisan migrate --force`) e compila assets.

## Middleware de Desenvolvimento

O middleware `MaintenanceERP` está aplicado ao grupo de rotas web em `routes/web.php` e controla o que já pode renderizar normalmente.

Rotas liberadas atualmente incluem:
- `home`
- `module.show`
- `module.item.development`
- `products.*`, `clients.*`, `vehicles.*`, `employees.*`, `suppliers.*`
- `role.*` (recurso de funções)

As demais rotas web retornam a view `system.desenvolvimento` até implementação completa.

## Filament

- Painel em `/admin`
- Provider registrado em `bootstrap/providers.php`
- Configuração em `app/Providers/Filament/AdminPanelProvider.php`
- Discovery automático em `app/Filament/Resources`, `app/Filament/Pages` e `app/Filament/Widgets`

Para criar usuário administrador:

```bash
php artisan make:filament-user
```
