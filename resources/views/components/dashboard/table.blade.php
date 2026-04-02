@props([
    'rows' => [],
])

<div class="nx-card nx-table-card">
    <div class="nx-table-wrap">
        <table class="nx-table">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th class="nx-th-right">Faturamento</th>
                    <th class="nx-th-center">Pedidos</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        <td>{{ $row['mes'] }}</td>
                        <td class="nx-td-right"><strong>R$ {{ number_format((float) $row['faturamento'], 2, ',', '.') }}</strong></td>
                        <td class="nx-td-center">{{ $row['pedidos'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="nx-td-center" style="padding: 16px; color: #64748B;">Nenhum resultado encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

