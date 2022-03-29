@extends('template.basedash')
@section('cssextra')
<link href="{{asset('vendor1/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="/correopdf1" id="form" enctype="multipart/form-data" method="POST">
    <div class="container-fluid">
        {{csrf_field()}}
        <!-- Pagina -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 id="focuss" class="h3 mb-0 text-gray-800 flex-grow-1">Proyeccion</h1>
            <button id="asd" data-toggle="modal" type="submit" data-target="#datos_busqueda" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Enviar al correo</button>
            <input type="text" name="id_proy" hidden value="{{$id}}">
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Proyeccion</h6>
            </div>
            <div class="card-body"> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputTipoSuelo">Tipo de suelo</label>
                        <select id="inputTipoSuelo" name="inputTipoSuelo" class="form-control">
                            @foreach ($tipos_suelo as $tipo_suelo)
                            <option value="{{$tipo_suelo}}">{{$tipo_suelo}}</option>
                            @endforeach
                        </select>
                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label for="inputDensidad">Densidad</label>
                                <input type="text" placeholder="Media Alta" class="form-control" name="inputDensidad" id="inputDensidad">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPAM">Porcentaje de área multifamiliar</label>
                                <input type="text" placeholder="NO APLICA" class="form-control" name="inputPAM" id="inputPAM">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label for="inputLMF">Lote minimo multifamiliar</label>
                                <input type="text" placeholder="NO APLICA" class="form-control" name="inputLMF" id="inputLMF">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCDE">Cajones de estacionamiento</label>
                                <input type="text" placeholder="1 CAJÓN POR VIVIENDA MAS 15% DEL TOTAL PARA VISITAS" name="inputCDE" class="form-control" id="inputCDE">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-6">
                                <label for="inputUsosViables">Usos viables</label>
                                @foreach ($usos_viables as $uso_viable)
                                <br>
                                <input type="checkbox" name="$inputUsosViables[]" value="{{$uso_viable}}" class="mr-2"><strong>{{$uso_viable}}</strong><br>
                                @endforeach
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputUsosCondicionados">Usos condicionados</label>
                                @foreach ($usos_condicionados as $uso_condicionado)
                                <br>
                                <input type="checkbox" name="$inputUsosCondicionados[]" value="{{$uso_condicionado}}" class="mr-2"><strong>{{$uso_condicionado}}</strong> <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="observacionesTextarea">Observaciones</label>
                        <textarea class="form-control" name="observacionesTextarea" style="resize:none;" id="observacionesTextarea" rows="18" placeholder="Agregue sus observaciones..."></textarea>
                    </div>
                </div>
            </div>
        </div>
     </div>
</form>
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
<script>
    function validarFormulario(evento) {
        var mensaje = confirm("¿Los datos ingresados son correctos?");
        console.log(mensaje)
        if (mensaje) {

        } else {

        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("form").addEventListener('submit', validarFormulario);
    });
</script>
@endsection
