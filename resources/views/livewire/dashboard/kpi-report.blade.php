<div class="nx-dashboard-page" wire:poll.10s="refreshData">
    <div class="nx-page-header" style="margin-bottom: 16px;">
        <div class="nx-page-header-left">
            <h1 class="nx-page-title">Indicadores KPI</h1>
            <p class="nx-page-subtitle">Analise de desempenho com graficos e drill-down por periodo.</p>
        </div>
        <div class="nx-page-actions">
            <a href="{{ route('dashboard.index') }}" class="nx-btn nx-btn-outline">Voltar para Visao Geral</a>
        </div>
    </div>

    <div class="nx-filters-bar" style="margin-bottom: 16px;">
        <div class="nx-search-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" wire:model.live.debounce.300ms="search" class="nx-search" placeholder="Buscar por mes, faturamento ou pedidos...">
        </div>

        @if($selectedMonth !== null)
            <div class="nx-filter-actions">
                <button type="button" wire:click="clearMonthFilter" class="nx-btn nx-btn-outline nx-btn-sm">Limpar filtro do grafico</button>
            </div>
        @endif
    </div>

    <div class="nx-dashboard-grid-2">
        <x-dashboard.chart-line id="kpi-line-chart" title="Evolucao de Faturamento" />
        <x-dashboard.chart-donut id="kpi-donut-chart" title="Distribuicao por Categoria" />
    </div>

    <x-dashboard.table :rows="$rows" />

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                let lineChart;
                let donutChart;

                const createCharts = () => {
                    const lineEl = document.querySelector('#kpi-line-chart');
                    const donutEl = document.querySelector('#kpi-donut-chart');

                    if (!lineEl || !donutEl || typeof ApexCharts === 'undefined') {
                        return;
                    }

                    if (!lineChart) {
                        lineChart = new ApexCharts(lineEl, {
                            chart: {
                                type: 'line',
                                height: 300,
                                toolbar: { show: false },
                                events: {
                                    dataPointSelection: function (event, chartContext, config) {
                                        if (window.Livewire) {
                                            window.Livewire.dispatch('filtrarMes', { mes: config.dataPointIndex });
                                        }
                                    }
                                }
                            },
                            stroke: { curve: 'smooth', width: 3 },
                            series: [{ name: 'Faturamento', data: [] }],
                            xaxis: { categories: [] },
                            yaxis: {
                                labels: {
                                    formatter: function (value) { return 'R$ ' + Number(value).toLocaleString('pt-BR'); }
                                }
                            },
                            colors: ['#3B82F6']
                        });

                        lineChart.render();
                    }

                    if (!donutChart) {
                        donutChart = new ApexCharts(donutEl, {
                            chart: { type: 'donut', height: 300 },
                            labels: [],
                            series: [],
                            legend: { position: 'bottom' },
                            colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444']
                        });

                        donutChart.render();
                    }
                };

                const updateCharts = (payload) => {
                    createCharts();
                    if (!lineChart || !donutChart || !payload) {
                        return;
                    }

                    lineChart.updateSeries([{ data: payload.faturamento ?? [] }]);
                    lineChart.updateOptions({ xaxis: { categories: payload.categorias ?? [] } });
                    donutChart.updateSeries(payload.distribuicao ?? []);
                    donutChart.updateOptions({ labels: payload.distribuicaoLabels ?? [] });
                };

                window.Livewire.on('updateCharts', (eventPayload) => {
                    const payload = Array.isArray(eventPayload) ? eventPayload[0] : eventPayload;
                    updateCharts(payload);
                });

                updateCharts({
                    faturamento: @js($faturamento),
                    categorias: @js($categorias),
                    distribuicao: @js($distribuicao),
                    distribuicaoLabels: @js($distribuicaoLabels),
                });
            });
        </script>
    @endpush
</div>

