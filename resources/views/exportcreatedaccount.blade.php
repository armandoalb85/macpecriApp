<table class="table table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Suscriptor</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Fecha de suscripción</th>
        <th>Tipo de suscripción</th>
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
            <td>
              @php($data = explode('-',$queryResult->suscripcion))
              {{ $data[2].'/'.$data[1].'/'.$data[0]}}
            </td>
            <td>{{$queryResult->typeSuscrupcion}}</td>
            <td>{{$queryResult->type}}</td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
