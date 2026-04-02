<div class="nx-dashboard-page">
    <div class="nx-page-header">
        <div class="nx-page-header-left">
            <h1 class="nx-page-title">Dashboard</h1>
            <p class="nx-page-subtitle">Escolha uma visualizacao para continuar.</p>
        </div>
    </div>

    <div class="nx-dashboard-kpis" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
        <a href="{{ route('dashboard.index') }}" class="nx-kpi-card" style="text-decoration: none;">
            <span class="nx-kpi-card-title">Visao Geral</span>
            <strong class="nx-kpi-card-value" style="font-size: 20px;">Abrir painel principal</strong>
        </a>

        <a href="{{ route('dashboard.kpi') }}" class="nx-kpi-card" style="text-decoration: none;">
            <span class="nx-kpi-card-title">Indicadores KPI</span>
            <strong class="nx-kpi-card-value" style="font-size: 20px;">Abrir relatorios</strong>
        </a>
    </div>
</div>

