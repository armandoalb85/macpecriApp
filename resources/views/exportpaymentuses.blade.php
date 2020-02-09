<table>
    <thead>
    <tr>
        <th>Canal de pago</th>
        <th>Pagos</th>
    </tr>
    </thead>
    <tbody>
      @if ($queryResults != null)
        @php($i = 0)
        @foreach($queryResults as $queryResult)
          <tr>
            <td>{{$queryResult->name}}</td>
            <td>{{$listUses[$i]}} @php($i++) </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="8">No se encontraron registros</td>
        </tr>
      @endif
</table>
