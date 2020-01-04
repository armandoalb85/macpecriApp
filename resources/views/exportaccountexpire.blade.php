<table>
    <thead>
    <tr>
        <th>Suscriptor</th>
        <th>Tipo de Cuenta</th>
        <th>Fecha de Pago</th>
        <th>Días para pagar</th>
        <th>Monto a Pagar</th>
    </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
          <tr>
            <td>{{ $queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{ $queryResult->type}}</td>
            <td>{{ $queryResult->startdate}}</td>
            <td>{{ $queryResult->daysforpaying}}</td>
            <td>{{ $queryResult->amount}}</td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
