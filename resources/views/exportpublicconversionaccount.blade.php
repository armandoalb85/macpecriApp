<table>
    <thead>
        <tr>
            <th class="text-center">Suscriptor</th>
            <th class="text-center">Correo</th>
            <th class="text-center">Fecha de suscripción</th>
            <th class="text-center">Fecha de conversión</th>
            <th class="text-center">Método de pago</th>
        </tr>
    </thead>
    <tbody>
        @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
        <tr>
            <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{$queryResult->email}}</td>
            <td>
                @php($data = explode(' ',$queryResult->created_at))
                @php($data = explode('-',$data[0]))
                {{ $data[2].'/'.$data[1].'/'.$data[0]}}
            </td>
            <td>
                @php($data = explode('-',$queryResult->startdate))
                {{ $data[2].'/'.$data[1].'/'.$data[0]}}
            </td>
            <td>{{$queryResult->method}}</td>
        </tr>
        @endforeach
        <tr>
            <td><strong>Total cuentas pagas</strong></td>
            <td>@if($totalPay != null){{$totalPay}} @else 0 @endif</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Total cuentas gratuitas</strong></td>
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