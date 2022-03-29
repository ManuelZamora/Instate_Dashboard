@extends('template.basedash')

@section('cssextra')
<link href="{{asset('vendor1/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
@if(Session::has('status'))
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<input hidden type="text" id="st" value="{{Session::get('status')}}">

    <script>
        var st = $('#st').val();
        alert(st)
    </script>

@endif
<div class="container-fluid">
    {{csrf_field()}}
    <!-- Pagina -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 id="focuss" class="h3 mb-0 text-gray-800">Proyectos cotizantes </h1>

    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabla de clientes</h6>
        </div>
        <div class="card-body" id="sa">
            <div class="table-responsive">
                {{csrf_field()}}
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            @if($cotizante=='pendiente')
                            <th>Creaccion</th>
                            @else
                            <th>Fecha entrega</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            @if($cotizante=='pendiente')
                            <th>Creaccion</th>
                            @else
                            <th>Fecha entrega</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($proyectos as $pro)
                        <tr>
                            <td>{{$pro['coti']->nombre}} </td>
                            <td>{{$pro->direccion}}</td>
                            <td>{{$pro['coti']->correo}} </td>
                            <td>{{$pro['tipo']->tipo}}</td>
                            <td>
                            @if($cotizante=='pendiente')
                            <a class="btn btn-success" href="/cotizando/{{$pro->id}}"> cotizar</a>
                            @else
                            {{$pro->f_entrega}}
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>


@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor1/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

@endsection
<script>
    setInterval(() => {
        $('#dataTable').load(' #dataTable');
    }, 2000);
</script>
