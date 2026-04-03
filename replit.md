# Nexora EMS ERP no Replit

Guia rápido para executar o `nexora-ems-erp` no Replit com o workflow já configurado no projeto.

## Status desta documentação

- Baseado no estado atual de `.replit`, `composer.json` e `package.json`
- Última revisão: 2026-04-03
- Documento principal do projeto: `README.md`

## Stack e ambiente no Replit

- PHP `8.2`
- Node.js `20`
- Módulo web habilitado
- Laravel `^12.0`
- Filament `^4.5`
- Livewire `^3.7`
- Vite `^7.0`

Configuração detectada em `.replit`:

- Workflow padrão: `Project`
- Comando de execução: `php artisan serve --host=0.0.0.0 --port=5000`
- Porta da aplicação: `5000` (mapeada para externa `80`)
- Porta reservada para front/HMR: `3000`
- Deploy build: `npm run build`

## Setup inicial (primeira execução)

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
```

Se quiser usar SQLite no Replit para reduzir dependências externas:

```bash
touch database/database.sqlite
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
sed -i 's/^DB_DATABASE=.*/DB_DATABASE=database\/database.sqlite/' .env
php artisan migrate --force
```

## Rodando a aplicação

Opção 1 (recomendada): clique no botão **Run** do Replit (workflow `Project`).

Opção 2 (manual):

```bash
php artisan serve --host=0.0.0.0 --port=5000
```

## Front-end (Vite)

Para desenvolvimento com HMR em porta separada:

```bash
npm run dev -- --host 0.0.0.0 --port 3000
```

Para build de produção:

```bash
npm run build
```

## Comandos úteis

```bash
php artisan route:list
php artisan optimize:clear
php artisan test
php artisan make:filament-user
```

## Observações importantes

- O middleware `MaintenanceERP` limita rotas ainda em desenvolvimento para a tela `system.desenvolvimento`.
- Rotas principais liberadas incluem `home`, `module.*`, `products.*`, `clients.*`, `suppliers.*`, `employees.*`, `vehicles.*`, `role.*`, `users.*`, `configuration.*`, `profile.*`, `permissions.*` e `logs.*`.
- Ao adicionar uma rota nova que deve abrir normalmente, inclua o padrão correspondente no whitelist de `app/Http/Middleware/MaintenanceERP.php`.

## Troubleshooting rápido

- Se houver erro de banco na subida, valide os `DB_*` no `.env`.
- Se os assets estiverem desatualizados, rode `npm run build` novamente.
- Se cache/rotas estiverem inconsistentes, rode `php artisan optimize:clear`.
