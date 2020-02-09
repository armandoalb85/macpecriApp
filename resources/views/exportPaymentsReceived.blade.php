<table>
    <thead>
    <tr>
        <th>Metodo de pago</th>
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
            <td>{{$queryResult->method}}</td>
            <td>{{$listTotal[$i]}} @php($i++)&nbsp;$</td>
          </tr>
        @endforeach
          <tr>
            <td><strong>Total:</strong></td>
            <td>
            {{$y}}&nbsp;$
            </td>
          </tr>
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
