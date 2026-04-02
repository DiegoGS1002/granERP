@props([
    'id',
    'title' => 'Distribuicao',
])

<div class="nx-card nx-chart-card">
    <div class="nx-chart-header">
        <h3>{{ $title }}</h3>
    </div>
    <div id="{{ $id }}" class="nx-chart"></div>
</div>

