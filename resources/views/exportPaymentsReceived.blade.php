<table class="table table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Tipo de Cuenta</th>
        <th>Monto</th>
    </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @php($i=0)
        @php($y=0)
        @foreach($queryResults as $queryResult)
          @php($y= $y + $listTotal[$i])
          <tr>
            <td>{{$queryResult->type}}</td>
            <td>{{$listTotal[$i]}} @php($i++)</td>
          </tr>
        @endforeach
          <tr>
            <td><strong>Total:</strong></td>
            <td>
            {{$y}}
            </td>
          </tr>
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
