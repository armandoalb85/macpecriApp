<table class="table table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Suscriptor</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Fecha de Suscripción</th>
        <th>Tipo de Cuenta</th>
    </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
          <tr>
            <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{$queryResult->username}}</td>
            <td>{{$queryResult->email}}</td>
            <td>{{$queryResult->suscripcion}}</td>
            <td>{{$queryResult->type}}</td>
          </tr>
        @endforeach
          <tr>
            <td><strong>Total Cuentas Pagas</strong></td>
            <td>@if($totalPay != null){{$totalPay}} @else 0 @endif</td>
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
          </tr>
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
