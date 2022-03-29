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
<div class="container-fluid">
    {{csrf_field()}}
    <!-- Pagina -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 id="focuss" class="h3 mb-0 text-gray-800">Creaccion > API Google</h1>
        <a id="asd" data-toggle="modal" data-target="#datos_busqueda" class="  d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            Generar Consulta</a>

    </div>
    <!-- DataTales  --> 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario</h6>
        </div>
        <div class="card-body">
            <div class="responsive">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Latitud">Latitud</label>
                            <input type="text" id="latitud" name="latitud" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Longitud">Longitud</label>
                            <input type="text" id="Longitud" name="Longitud" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group input-group">
                            <input type="text" id="search_location" class="form-control" placeholder="Search location">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-default get_map" type="submit">
                                    Localizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="mapa" style="width: 100%; height: 500px">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- -->




</div>

<!-- Modal -->
<div class="modal fade" id="datos_busqueda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">Datos Geocoding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/busqueda" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}

                    <div class="datos">

                        <div class="form-row">
                            <div class="form-group campo col-md-8">
                            <div class="custom-file">
                        <input type="file" class="custom-file-input" lang="es" for="fileMapaCalor">
                        <label class="custom-file-label" for="fileMapaCalor" data-browse="Buscar">Seleccionar mapa de calor</label>
                    </div>
                            </div>
                            <div class="form-group campo col-md-4">
                                <label for="inputPassword4">Longitud </label>
                                <input type="text" readonly id="dlongitud" class="form-control" name="dlongitud">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group campo col-md-8">
                                <label for="inputAddress">Direccion </label>
                                <input type="text" readonly class="form-control" name="ddireccion" id="ddireccion">

                            </div>
                            <div class="form-group campo col-md-2">
                                <label for="inputAddress2">Numero (#) </label>
                                <input type="text" readonly class="form-control" name="dnumero" id="dnumero">

                            </div>
                            <div class="form-group campo col-md-2">
                                <label for="inputAddress2">Codigo Postal </label>
                                <input type="text" readonly class="form-control" name="dcodigo" id="dcodigo">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group campo col-md-4">
                                <label for="inputZip">Colonia </label>
                                <input type="text" readonly class="form-control" name="dcolonia" id="dcolonia">

                            </div>
                            <div class="form-group campo col-md-4">
                                <label for="inputZip">Estado </label>
                                <input type="text" readonly class="form-control" name="destado" id="destado">

                            </div>
                            <div class="form-group campo col-md-4">
                                <label for="inputZip">Municipio </label>
                                <input type="text" readonly class="form-control" name="dmuni" id="dmuni">

                            </div>

                        </div>
                    </div>
                    <div class="error">
                        <h5>Genere una Busqueda Primero</h5>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" disabled class="btn btn-primary guardar">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>




@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA&callback=iniciarMapa"></script>
<!-- Page level plugins -->
<script src="{{asset('vendor1/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script src="{{asset('js/unico.js')}}"> </script>
<script>
    
    var mapa 
    var marcador
    function iniciarMapa() {
        var latitud = 25.542243;
        var longitud = -103.384470;
        cordenadas = {
            lng: longitud,
            lat: latitud
        }
        generarMapa(cordenadas);
    }

    function generarMapa(cordenadas) {
        mapa= new google.maps.Map(document.getElementById('mapa'), {
            zoom: 12,
            center: new google.maps.LatLng(cordenadas.lat, cordenadas.lng)
        });

        marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(cordenadas.lat, cordenadas.lng)
        });

        marcador.addListener('dragend', function(event) {
            console.log(this)
            document.getElementById('latitud').value = this.getPosition().lat();
            document.getElementById('Longitud').value = this.getPosition().lng();
        })
    }


    $(document).ready(function() {




        iniciarMapa();


        var geocoder = new google.maps.Geocoder();
        var PostCodeid = '#search_location';
        $(function() {
            $(PostCodeid).autocomplete({
                source: function(request, response) {
                    geocoder.geocode({
                        'address': request.term
                    }, function(results, status) {
                        response($.map(results, function(item) {
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                lat: item.geometry.location.lat(),
                                lon: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function(event, ui) {


                    cordenadas = {
                        lng: ui.item.lon,
                        lat: ui.item.lat
                    }
                    generarMapa(cordenadas);
                }
            });
        });

        $('.get_map').click(function(e) {
            var address = $(PostCodeid).val();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    mapa.setCenter(results[0].geometry.location);
                    marcador.setPosition(results[0].geometry.location);
                    $('#ddireccion').val(results[0].formatted_address);
                    console.log("este info");
                    console.log(results[0]);
                    $('#dlatitud').val(marcador.getPosition().lat());
                    $('#dlongitud').val(marcador.getPosition().lng());
                    cordenadas = {
                        lng: marcador.getPosition().lng(),
                        lat: marcador.getPosition().lat()
                    }
                    generarMapa(cordenadas);
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
            e.preventDefault();
            
            //aqui setearemos los valores en el modal
            // aqui debemos de buscar si se puede traer por separado la calle, numero, colonia, codigo postal, ciudad y estado
            //en dado caso de que no se puede traer por ceparado, tratar de filtrar la informacion y separarla manualmente
            // en dado caso de que no se pueda sacar la direccion junta, tratar de sacarla de otra manera ya sea atravez de la api o  de otra forma
            //tambien de aqui llenar los datos del modal para mandlos al controlador y hacer la conexion con la api
           // $("#dlatitud").val(25.542243)
            //$("#dlongitud").val(-103.384470)
            //$("#ddireccion").val("C. Isla Montage")
            $("#dnumero").val(850)
            $("#dcodigo").val(27085)
            $("#dcolonia").val("Villa California")
            $("#destado").val("Coahuila")
            $("#dmuni").val("Monterrey")
            console.log("hola")
        });
        $("#search_location").focus(function() {
            $("#dlatitud").val('')
            $("#dlongitud").val('')
            $("#ddireccion").val('')
            $("#dnumero").val('')
            $("#dcodigo").val('')
            $("#dcolonia").val('')
            $("#destado").val('')
            $("#dmuni").val('')


        });
        $("#asd").click(function() {
            if ($("#dlatitud").val() == '') {
                $(".error").show(); 
                $(".datos").hide();
                $(".guardar").prop('disabled', true);
            } else {
                $(".error").hide();
                $(".datos").show();
                $(".guardar").prop('disabled', false);
            }


        });

    });
</script>
@endsection