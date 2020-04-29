<table>
    <thead>
        <tr>
            <th>Suscriptor</th>
            <th>Correo</th>
            <th>Fecha de pago</th>
            <th>Días para pagar</th>
            <th>Monto a pagar</th>
        </tr>
    </thead>
    <tbody>
        @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
        <tr>
            <td class="text-center">{{ $queryResult->name." ".$queryResult->lastname}}</td>
            <td class="text-center">{{ $queryResult->email}}</td>
            <td class="text-center">
                {{ date('d/m/Y',strtotime($queryResult->closedate)) }}
            </td>
            <td class="text-center">{{ $queryResult->days_for_expire}}</td>
            <td class="text-center">{{ number_format($queryResult->amount, 2 , ',' , '.') }} USD
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8">No se encontraron registros</td>
        </tr>
        @endif
    </tbody>
</table>