<table>
    <thead>
        <tr>
            <th>Canal de pago</th>
            <th>Pagos</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
        <tr>
            <td>{{$queryResult->name}}</td>
            <td>{{$queryResult->counting}}</td>
            <td>{{ number_format($queryResult->amount, 2 , ',' , '.') }} USD</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8">No se encontraron registros</td>
        </tr>
        @endif
    </tbody>
</table>