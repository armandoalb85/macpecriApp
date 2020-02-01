<table>
    <thead>
      <tr>
          <th>Suscriptor</th>
          <th>Usuario</th>
          <th>Correo</th>
          <th>Tipo de cuenta</th>
          <th>Fecha de pago</th>
          <th>Días para pagar</th>
          <th>Monto a pagar</th>
      </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
          <tr>
            <td>{{ $queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{ $queryResult->user}}</td>
            <td>{{ $queryResult->email}}</td>
            <td>{{ $queryResult->type}}</td>
            <td>
              @php($data = explode('-',$queryResult->startdate))
              {{ $data[2].'/'.$data[1].'/'.$data[0]}}
            </td>
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
