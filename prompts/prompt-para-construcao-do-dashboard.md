# 🚀 Guia Avançado: Dashboard Profissional (Laravel + Livewire + ApexCharts)

## 🎯 Objetivo

Construir um dashboard estilo **Power BI / SaaS moderno**, com:

* KPIs dinâmicos
* Gráficos interativos
* Filtros globais
* Drill-down
* Atualização em tempo real

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
 └── Dashboard.php

resources/views/
 ├── livewire/
 │    └── dashboard.blade.php
 ├── components/
 │    ├── kpi-card.blade.php
 │    ├── chart-line.blade.php
 │    ├── chart-donut.blade.php
 │    └── table.blade.php
```

---

# ⚙️ 3. Componente Livewire (Avançado)

```php
class Dashboard extends Component
{
    public $periodo = 'mes';
    public $dataInicio;
    public $dataFim;

    public $faturamento = [];
    public $categorias = [];
    public $distribuicao = [];

    public function mount()
    {
        $this->dataInicio = now()->startOfMonth();
        $this->dataFim = now()->endOfMonth();

        $this->loadData();
    }

    public function loadData()
    {
        // Simulação (substituir por queries reais)
        $this->faturamento = [12000, 19000, 30000, 50000];
        $this->categorias = ['Jan', 'Fev', 'Mar', 'Abr'];
        $this->distribuicao = [34, 28, 20, 18];

        $this->dispatch('updateCharts', [
            'faturamento' => $this->faturamento,
            'categorias' => $this->categorias,
            'distribuicao' => $this->distribuicao
        ]);
    }

    public function updatedPeriodo()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
```

---

# 🎨 4. Filtros Globais

```blade
<div class="flex gap-4 mb-6">
    <select wire:model="periodo" class="border rounded p-2">
        <option value="mes">Mês</option>
        <option value="ano">Ano</option>
    </select>

    <input type="date" wire:model="dataInicio" />
    <input type="date" wire:model="dataFim" />
</div>
```

---

# 📊 5. Gráficos Avançados

## Inicialização

```javascript
let chartLine;
let chartDonut;

document.addEventListener('livewire:load', function () {

    chartLine = new ApexCharts(document.querySelector("#chart-line"), {
        chart: { type: 'line', height: 300 },
        series: [{ name: 'Faturamento', data: [] }],
        xaxis: { categories: [] }
    });

    chartLine.render();

    chartDonut = new ApexCharts(document.querySelector("#chart-donut"), {
        chart: { type: 'donut' },
        series: [],
        labels: ['Comércio', 'Construção', 'Serviços', 'Tecnologia']
    });

    chartDonut.render();
});
```

---

# 🔄 6. Atualização Dinâmica

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

# 🔍 7. Drill-down (Nível Power BI)

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

# ⚡ 8. Tempo Real

```blade
<div wire:poll.10s>
    <!-- dashboard -->
</div>
```

---

# 📋 9. Tabela Inteligente

## Funcionalidades

* Paginação
* Busca
* Ordenação

```blade
<input type="text" wire:model="search" placeholder="Buscar..." />
```

---

# 🎨 10. Design Profissional

## Classes padrão

```
bg-white
rounded-2xl
shadow-sm
hover:shadow-md
transition-all
p-4
```

## Grid

```
grid grid-cols-4 gap-6
```

---

# 🧠 11. Boas Práticas

## Faça

* Componentize tudo
* Use eventos do Livewire
* Atualize gráficos sem recriar

## Não faça

* Misturar lógica JS com Blade
* Recarregar página

---

# 🚀 12. Evolução do Sistema

## Próximos níveis

* Multi-tenant dashboards
* Permissões por usuário
* Exportação PDF
* Integração com BI externo

---

# 🏁 Conclusão

Você agora tem um dashboard:

* Escalável
* Profissional
* Interativo
* Nível SaaS

Pronto para produção 🚀
