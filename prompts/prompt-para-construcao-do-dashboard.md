# 🚀 Guia Avançado: Dashboard Profissional (Laravel + Livewire + ApexCharts)

## 🎯 Objetivo

Construir um dashboard estilo **Power BI / SaaS moderno**, agora organizado em duas grandes áreas:

1. **Visão Geral** → painel principal com métricas do sistema
2. **Indicadores KPI** → relatórios e análise de desempenho

---

# 🧱 1. Arquitetura Profissional

## Camadas

### Backend (Livewire)

* Responsável por dados
* Filtros
* Regras de negócio

### Frontend (Blade + Tailwind)

* Layout
* Componentização

### Visualização (ApexCharts)

* Renderização
* Atualizações dinâmicas

---

# 📁 2. Estrutura de Projeto

```
app/Livewire/
 ├── Dashboard.php
 ├── Overview.php
 └── KpiReport.php

resources/views/
 ├── livewire/
 │    ├── dashboard.blade.php
 │    ├── overview.blade.php
 │    └── kpi-report.blade.php
 ├── components/
 │    ├── kpi-card.blade.php
 │    ├── chart-line.blade.php
 │    ├── chart-donut.blade.php
 │    └── table.blade.php
```

---

# 🧭 3. VISÃO GERAL (Overview)

## 🎯 Objetivo

Mostrar rapidamente o estado do sistema:

* Faturamento
* Pedidos
* Estoque
* Despesas

---

## 🧠 Livewire (Overview.php)

```php
class Overview extends Component
{
    public $kpis = [];

    public function mount()
    {
        $this->kpis = [
            'faturamento' => 128590,
            'produtos' => 5284,
            'pedidos' => 72,
            'despesas' => 78445
        ];
    }

    public function render()
    {
        return view('livewire.overview');
    }
}
```

---

## 🎨 Blade (overview.blade.php)

```blade
<div class="grid grid-cols-4 gap-6 mb-6">
    <x-kpi-card title="Faturamento" :value="$kpis['faturamento']" />
    <x-kpi-card title="Produtos" :value="$kpis['produtos']" />
    <x-kpi-card title="Pedidos" :value="$kpis['pedidos']" />
    <x-kpi-card title="Despesas" :value="$kpis['despesas']" />
</div>
```

---

# 📊 4. INDICADORES KPI (Relatórios)

## 🎯 Objetivo

Análise profunda de desempenho:

* Evolução de faturamento
* Distribuição por categoria
* Performance por período

---

## 🧠 Livewire (KpiReport.php)

```php
class KpiReport extends Component
{
    public $faturamento = [];
    public $categorias = [];
    public $distribuicao = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->faturamento = [12000, 19000, 30000, 50000];
        $this->categorias = ['Jan', 'Fev', 'Mar', 'Abr'];
        $this->distribuicao = [34, 28, 20, 18];

        $this->dispatch('updateCharts', [
            'faturamento' => $this->faturamento,
            'categorias' => $this->categorias,
            'distribuicao' => $this->distribuicao
        ]);
    }

    public function render()
    {
        return view('livewire.kpi-report');
    }
}
```

---

# 📈 5. Gráficos (KPI)

```javascript
Livewire.on('updateCharts', data => {

    chartLine.updateSeries([{ data: data.faturamento }]);

    chartLine.updateOptions({
        xaxis: { categories: data.categorias }
    });

    chartDonut.updateSeries(data.distribuicao);
});
```

---

# 🔍 6. Drill-down (Nível Power BI)

```javascript
chartLine.updateOptions({
    chart: {
        events: {
            dataPointSelection: function(event, chartContext, config) {
                let mes = config.dataPointIndex;
                Livewire.dispatch('filtrarMes', { mes });
            }
        }
    }
});
```

---

# ⚡ 7. Tempo Real

```blade
<div wire:poll.10s>
    <!-- dashboard -->
</div>
```

---

# 📋 8. Tabela Inteligente

```blade
<input type="text" wire:model="search" placeholder="Buscar..." />
```

---

# 🎨 9. Design Profissional

```
bg-white
rounded-2xl
shadow-sm
hover:shadow-md
transition-all
p-4
```

---

# 🧠 10. Boas Práticas

## Faça

* Separar visão geral de análise
* Componentizar tudo
* Atualizar gráficos dinamicamente

## Não faça

* Misturar responsabilidades
* Recarregar página

---

# 🚀 11. Evolução

* Dashboards por módulo (Financeiro, Vendas)
* Permissões por usuário
* Exportação de relatórios

---
