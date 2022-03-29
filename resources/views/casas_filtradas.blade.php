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
        <h1 id="focuss" class="h3 mb-0 text-gray-800">Creaccion > Casa en Venta > Resultado</h1>
        <a id="asd" data-toggle="modal" data-target="#datos_busqueda" class="  d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            Enviar al correo</a>

    </div>
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario</h6>

        </div>
        <div class="card-body"> 
            <div class="responsive">





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
               
                    {{csrf_field()}}
                    <input type="text" id="lat" name="lat" value="{{$latitud}}" hidden>
                    <input type="text" id="lng" name="lng" value="{{$longitud}}"hidden>
                    <input type="text" id="ciudad" name="ciudad" value="{{$ciud}}"hidden >
                    <input type="text" id="estado" name="estado" value="{{$estd}}"hidden >
                    <input type="text" id="ndirec" name="ndirec" value="{{$ndirec}}"hidden >

                    <div class="datos">

                        
                    <div class="form-row">
                            <div class="form-group campo col-md-12">
                                <label for="inputAddress">Correo </label>
                                <input type="text"  class="form-control" name="correo" id="correo">

                            </div>
                        </div><div class="form-row">
                            <div class="form-group campo col-md-12">
                                <label for="inputAddress">Nombre del cotizante  </label>
                                <input type="text"  class="form-control" name="cotizante" id="cotizante">

                            </div>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="correo(this.value)" id="but" class="btn btn-primary guardar">Guardar</button>
            </div>
            
        </div>
    </div>
</div>

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
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script>
    var datos={!! json_encode($datos_filtrados->toArray(), JSON_HEX_TAG) !!};
    var ubicaciones={!! json_encode($ubicaciones_filtradas, JSON_HEX_TAG) !!};
    var corde={!! json_encode($corde, JSON_HEX_TAG) !!};
    console.log(datos);
    console.log("ubi");
    console.log(ubicaciones);
    console.log("corde");
    console.log(corde);


    var lati = $('#lat').val() + 0
    var lngi = $('#lng').val() + 0

    var lati2 = corde[0]['latitud'] + 0
    var lngi2 = corde[0]['longitud'] + 0
    console.log("asdasd", lati2, "asdasd", lngi2)
    console.log(lati, "lat");

    function initMap() {
        var lati = $('#lat').val() + 0
        var lngi = $('#lng').val() + 0
        console.log(lati, "lat", lngi);
        const map = new google.maps.Map(document.getElementById("mapa"), {
            zoom: 12,
            center: new google.maps.LatLng(lati2, lngi2),
        });
        // Set LatLng and title text for the markers. The first marker (Boynton Pass)
        // receives the initial focus when tab is pressed. Use arrow keys to
        // move between markers; press tab again to cycle through the map controls.
        const tourStops = ubicaciones;
        console.log(tourStops)
        // Create an info window to share between markers.
        const infoWindow = new google.maps.InfoWindow();

        // Create the markers.
        i = 0;
        ubicaciones.forEach(s => {
            console.log(s['lat'], s['lng'])
            const marker = new google.maps.Marker({
                map: map,
                draggable: false,
                position: new google.maps.LatLng(s['lat'], s['lng']),
                title: `${i + 1}.${s['ubicacion']}`,
                label: `${i + 1}`,
                optimized: false,

            });
            i = i + 1;
            marker.addListener("click", () => {
                imprimir(s['ubicacion'])
            });
        });

    }

    function imprimir(s) {
        datos.forEach(element => {
            if (s == element['ubicacion']) {
                console.log(element['ubicacion'])
            }
        });
    }
</script>
 
<script>
    function correo(a) {
        console.log(a);
        
      // butons.disabled = true
        lat = $('#lat').val();
        lng= $('#lng').val();
        ciudad= $('#ciudad').val();
        estado=$('#estado').val();
        ndirec=$('#ndirec').val();
        correo=$('#correo').val();
        cotizante=$('#cotizante').val();
        console.log(lat,lng,ciudad,estado, ndirec,correo,cotizante)
        
        //console.log("b,2",b);
        if(correo!=0){
            $("#but").prop('disabled', true);
            token = $("input[name = '_token']").val();
        $.ajax({
                data: {
                    lat:lat,
                    lng:lng,
                    ciudad:ciudad,
                    estado:estado,
                    correo:correo,
                    cotizante: cotizante,
                    ndirec:ndirec,
                    _token: token
                },
                datatype: 'JSON',
                type: 'POST',
                url: '/correo', 
                //8714630904
                success: function(response) {

                    if (response.respuesta == 1) {
                        alert(response.mensaje);
                    } else {}
                    
        $("#but").prop('disabled', false);
                }
            });
        }
        else{
            
        }
    }
</script>
@endsection