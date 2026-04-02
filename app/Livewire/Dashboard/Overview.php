<?php

namespace App\Livewire\Dashboard;

use App\Services\Dashboard\DashboardMetricsService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard - Visao Geral')]
class Overview extends Component
{
    public array $kpis = [];

    public function mount(DashboardMetricsService $metrics): void
    {
        $this->kpis = $metrics->getOverviewKpis();
    }

    public function refreshKpis(DashboardMetricsService $metrics): void
    {
        $this->kpis = $metrics->getOverviewKpis();
    }

    public function render()
    {
        return view('livewire.dashboard.overview');
    }
}

