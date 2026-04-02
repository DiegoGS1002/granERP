<div class="nx-dashboard-page" wire:poll.10s="refreshKpis">
    <div class="nx-page-header" style="margin-bottom: 16px;">
        <div class="nx-page-header-left">
            <h1 class="nx-page-title">Dashboard - Visao Geral</h1>
            <p class="nx-page-subtitle">Resumo rapido com as principais metricas do sistema.</p>
        </div>
        <div class="nx-page-actions">
            <a href="{{ route('dashboard.kpi') }}" class="nx-btn nx-btn-primary">Ver Indicadores KPI</a>
        </div>
    </div>

    <div class="nx-dashboard-kpis">
        <x-dashboard.kpi-card title="Faturamento" :value="$kpis['faturamento'] ?? 0" :currency="true" />
        <x-dashboard.kpi-card title="Produtos" :value="$kpis['produtos'] ?? 0" />
        <x-dashboard.kpi-card title="Pedidos" :value="$kpis['pedidos'] ?? 0" />
        <x-dashboard.kpi-card title="Despesas" :value="$kpis['despesas'] ?? 0" :currency="true" />
    </div>
</div>

