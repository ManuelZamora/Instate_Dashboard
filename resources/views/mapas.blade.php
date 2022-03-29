@extends('template.basedash')

@section('cssextra')
<style>
  .error {
    display: none;
  }
</style>

<script>
  
  "use strict";

  

  function initMap() {
    const componentForm = [
      'sublocality_level_1', //colonia
      'street_number', //numero de la casa
      'location', //ciudad
      'route', //dirreccion
      'locality', //ciudad
      'administrative_area_level_1', //estado
      'postal_code', //codigo postal
    ];
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: {
        lat: 25.542243,
        lng: -103.384470
      },
      mapTypeControl: false,
      fullscreenControl: true,
      zoomControl: true,
      streetViewControl: false
    });
    const marker = new google.maps.Marker({
      map: map,
      draggable: false
    });
    const autocompleteInput = document.getElementById('location');
    const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
      fields: ["address_components", "geometry", "name"],
      types: ["address"],
    });
    autocomplete.addListener('place_changed', function() {
      marker.setVisible(false);
      const place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert('No details available for input: \'' + place.name + '\'');
        return;
      }
      console.log("placesasas");
      console.log(place);
      renderAddress(place);
      fillInAddress(place);
    });

    function fillInAddress(place) { // optional parameter
      console.log("place")
      console.log(place)
      console.log("latitud")
      console.log(place.geometry.location.lat())

      console.log("longitud")
      console.log()
      const addressNameFormat = {
        'sublocality_level_1': 'long_name',
        'street_number': 'long_name',
        'route': 'long_name',
        'locality': 'long_name',
        'administrative_area_level_1': 'long_name',
        'postal_code': 'long_name',
      }; 

      const getAddressComp = function(type) {
        console.log("nameformat")
        console.log(addressNameFormat)
        console.log("palce.addres_com")
        console.log(place.address_components)
        for (const component of place.address_components) {
          if (component.types[0] === type) {
            return component[addressNameFormat[type]];
          }
        }
        return '';
      };

      for (const component of componentForm) {
        // segun el componente se llena su dato
        if (component !== 'location') {
          document.getElementById(component).value = getAddressComp(component);
        }
      }
      document.getElementById('dlatitud').value = place.geometry.location.lat()
      document.getElementById('dlongitud').value = place.geometry.location.lng()
      document.getElementById('nombre').value = place.name
     
    }

    function renderAddress(place) {
      map.setCenter(place.geometry.location);
      map.setZoom(14);
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);
    }
  }
</script>
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
          <div class="col-md-12">
            <div class="form-group input-group">
              <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
              <input type="text" id="location" class="form-control" placeholder="Search location">
              <div class="input-group-btn">
                
              </div>
            </div>
          </div>
        </div>
       {{ $mapa}}
        <div class="row">
          <div class="col-md-12">
          <img src="{{asset($mapa)}}" alt="">
          </div>
        </div>


      </div>
    </div>
  </div>
  <!-- -->




</div>

<!-- Modal -->
 



@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor1/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

<script>
  
  
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
</script>
@endsection