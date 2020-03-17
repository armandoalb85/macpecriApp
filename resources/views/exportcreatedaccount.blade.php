<table class="table table-bordered table-hover dataTables-example">
    <thead>
        <thead>
            <tr>
                <th class="text-center">Suscriptor</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Fecha de suscripción</th>
                <th class="text-center">Tipo de suscripción</th>
            </tr>
        </thead>
    <tbody>

        @if ($queryResults != null)
        @foreach($queryResults as $queryResult)
        <tr>
            <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
            <td>{{$queryResult->email}}</td>
            <td>{{date('d/m/Y', strtotime($queryResult->suscripcion))}}</td>
            <td>{{$queryResult->typeSuscrupcion}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8">No se encontraron registros</td>
        </tr>
        @endif
    </tbody>
</table>