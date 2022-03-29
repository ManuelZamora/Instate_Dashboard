@extends('template.basedash')

@section('cssextra')
<style>
    .error {
        display: none;
    }
</style>
<!-- Custom styles for this page this -->
<link href="{{asset('vendor1/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="/correopdf4" id="form" enctype="multipart/form-data" method="POST">
    <div class="container-fluid">
        {{csrf_field()}}
        <!-- Pagina -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 id="focuss" class="h3 mb-0 text-gray-800">Creaccion > Proyecto 4 > Resultado</h1>
            <button id="asd" data-toggle="modal" type="submit" data-target="#datos_busqueda" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">    
                Enviar al correo</button>
        </div>
        <!-- DataTales  -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulario</h6>

            </div>
            <div class="card-body">
                <div class="responsive">
                    <input type="text" name="id_proy" hidden value="{{$id}}">
                    <div class="row">
                        <div class="col-md-12">
                            <h4> El proyecto tendra un costo total de {{$red}}</h4>
                        </div>
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA&callback=initMap"></script>
<!-- Page level plugins -->
<script src="{{asset('vendor1/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->

@endsection