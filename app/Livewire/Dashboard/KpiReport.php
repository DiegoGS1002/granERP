<?php

namespace App\Livewire\Dashboard;

use App\Services\Dashboard\DashboardMetricsService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard - Indicadores KPI')]
class KpiReport extends Component
{
    public array $faturamento = [];

    public array $categorias = [];

    public array $distribuicao = [];

    public array $distribuicaoLabels = [];

    public array $tableRows = [];

    public string $search = '';

    public ?int $selectedMonth = null;

    public function mount(DashboardMetricsService $metrics): void
    {
        $this->loadData($metrics);
    }

    public function refreshData(DashboardMetricsService $metrics): void
    {
        $this->loadData($metrics);
    }

    #[On('filtrarMes')]
    public function filtrarMes(int|string $mes): void
    {
        if (! is_numeric($mes)) {
            return;
        }

        $this->selectedMonth = (int) $mes;
    }

    public function clearMonthFilter(): void
    {
        $this->selectedMonth = null;
    }

    public function loadData(DashboardMetricsService $metrics): void
    {
        $data = $metrics->getKpiReportData();

        $this->faturamento = $data['faturamento'];
        $this->categorias = $data['categorias'];
        $this->distribuicao = $data['distribuicao'];
        $this->distribuicaoLabels = $data['distribuicao_labels'];
        $this->tableRows = $data['table_rows'];

        $this->dispatch('updateCharts',
            faturamento: $this->faturamento,
            categorias: $this->categorias,
            distribuicao: $this->distribuicao,
            distribuicaoLabels: $this->distribuicaoLabels,
        );
    }

    public function getFilteredTableRowsProperty(): array
    {
        $rows = collect($this->tableRows);

        if ($this->selectedMonth !== null) {
            $rows = $rows->where('month_index', $this->selectedMonth);
        }

        if ($this->search !== '') {
            $term = mb_strtolower($this->search);

            $rows = $rows->filter(function (array $row) use ($term) {
                $searchable = implode(' ', [
                    $row['mes'] ?? '',
                    (string) ($row['faturamento'] ?? ''),
                    (string) ($row['pedidos'] ?? ''),
                ]);

                return str_contains(mb_strtolower($searchable), $term);
            });
        }

        return $rows->values()->all();
    }

    public function render()
    {
        return view('livewire.dashboard.kpi-report', [
            'rows' => $this->filteredTableRows,
        ]);
    }
}

