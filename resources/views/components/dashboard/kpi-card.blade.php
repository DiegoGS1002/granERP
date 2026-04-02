@props([
    'title',
    'value' => 0,
    'icon' => null,
    'currency' => false,
])

@php
    $formattedValue = $currency
        ? 'R$ ' . number_format((float) $value, 2, ',', '.')
        : number_format((float) $value, 0, ',', '.');
@endphp

<div class="nx-kpi-card">
    <div class="nx-kpi-card-head">
        <span class="nx-kpi-card-title">{{ $title }}</span>
        @if($icon)
            <span class="nx-kpi-card-icon">{!! $icon !!}</span>
        @endif
    </div>
    <strong class="nx-kpi-card-value">{{ $formattedValue }}</strong>
</div>

