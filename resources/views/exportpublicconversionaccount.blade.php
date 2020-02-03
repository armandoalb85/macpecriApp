<table>
    <thead>
    <tr>
        <th>Suscriptor</th>
        <th>Correo</th>
        <th>Fecha de suscripción</th>
        <th>Fecha de Conversión</th>
        <th>Cuenta</th>
        <th>Método de pago</th>
    </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
          <tr>
            <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{$queryResult->email}}</td>
            <td>{{$queryResult->created_at}}</td>
            <td>{{$queryResult->startdate}}</td>
            <td>{{$queryResult->type}}</td>
            <td>{{$queryResult->method}}</td>
          </tr>
        @endforeach
          <tr>
            <td><strong>Total Cuentas Pagas</strong></td>
            <td>@if($totalPay != null){{$totalPay}} @else 0 @endif</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><strong>Total Cuentas Gratuitas</strong></td>
            <td>@if($totalFree != null){{$totalFree}} @else 0 @endif</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
