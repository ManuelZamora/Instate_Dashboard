@extends('template.basedash')

@section('cssextra')
<link href="{{asset('vendor1/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
    .texto {
        text-align: center;
        margin-top: 2rem;
    }

    .prim {
        border-bottom: 2px solid #ddd;
        padding-bottom: 2rem;
    }

    .abs1 {
        margin-top: 2rem;
        text-align: center;
    }

    .abs2 {
        margin-top: 2rem;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">

    {{csrf_field()}}
    <!-- Pagina -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 id="focuss" class="h3 mb-0 text-gray-800 flex-grow-1">Estudio de Mercado</h1>
        <a id="asd" data-toggle="modal" data-target="#datos_busqueda" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            Enviar al correo</a>


    </div>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Precio Promedio</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ubicacion</th>
                                    <th>promedio</th>
                                    <th>PRECIO MAXIMO M2</th>
                                    <th>PRECIO MINIMO M2</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ubicacion</th>
                                    <th>promedio</th>
                                    <th>PRECIO MAXIMO M2</th>
                                    <th>PRECIO MINIMO M2</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($ubi_costo as $pro)
                                <tr>
                                    <td>{{$pro['ubicacion']}} </td>
                                    <td>{{$pro['promedio']}}</td>
                                    <td>{{$pro['mayor']}} </td>
                                    <td>{{$pro['menor']}}</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informacion detallada</h6>
                </div>
                <div class="card-body">
                    <div class="row prim">
                        <div class="col-md-4 texto">
                            <h5>PRECIO PROMEDIO POR M2</h5>
                            <h6>$52,449.51</h6>
                        </div>
                        <div class="col-md-4 texto">
                            <h5>LA PROPIEDAD MAS CARA DE LA ZONA CUESTA.</h5>
                            <h6>$65,000,000.00</h6>
                        </div>
                        <div class="col-md-4 texto">
                            <h5>LA PROPIEDAD MAS BARATA DE LA ZONA CUESTA.</h5>
                            <h6>$4,780,000.00</h6>
                        </div>

                    </div>

                    <div class="row prim">
                        <div class="col-md-4 texto">
                            <h5>ÁREA MINIMA</h5>
                            <h6>92 M2</h6>
                        </div>
                        <div class="col-md-4 texto">
                            <h5>ÁREA MÁXIMA.</h5>
                            <h6>1.420 M2</h6>
                        </div>
                        <div class="col-md-4 texto">
                            <h5>ÁREA PROMEDIO.</h5>
                            <h6>420,89 M2</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 abs1">
                            <h4>ÁABSORCIÓN APROX. DE PROPIEDADES AL MES.</h4>
                            <h5>0,5</h5>
                        </div>
                        <div class="col-md-4 abs2">
                            <h5>LO QUE QUIERE DECIR QUE SE VENDEN APROXIMADAMENTE 6 PROPIEDADES AL AÑO</h5>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

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
                <form action="/correo2" id="form" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="mpcalor">
                        <div class="form-row">
                            <div class="form-group campo col-md-12">


                                <a href="/calor" target="_blank" class="d-sm-inline-block btn   btn-primary shadow-sm ml-2">
                                    Generar MAPA DE CALOR</a>
                            </div>
                        </div>
                    </div>

                    <div class="datos">

                        <div class="form-row">
                            <div class="form-group campo col-md-12">
                                <div class="mb-3">
                                    <input type="text" hidden id="id_proy" name="id_proy" value="{{$id_proyect}}">
                                    <label for="file" class="form-label">Ingrese el mapa:</label> <br>
                                    <input class="form-control" onchange="validar()" accept=".png" name="file" type="file" id="file">
                                    @error('file')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                            </div>

                        </div>


                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit"   class="btn btn-primary guardar">Enviar al Correo</button>
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

<!-- Page level plugins -->
<script src="{{asset('vendor1/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<!-- Page level plugins -->


<script src="{{asset('vendor1/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('js/estudio_mercado.js')}}"></script>


<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    var ddata={!! json_encode($ddata, JSON_HEX_TAG) !!};

var lubis={!! json_encode($lubis, JSON_HEX_TAG) !!};

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: lubis,
            datasets: [{
                label: "Revenue",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: ddata,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {

            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                displayColors: false,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });
</script>
 
<script>
    //mapa de calor y envio de correo
    
    function validarFormulario(evento) {
        var a=0
  evento.preventDefault();
  let archivo = document.getElementById('file').value
  console.log(archivo);
  if(archivo == "") {
    alert('No has ingresado el mapa de calor2');
    return;
  }
   
     
   
   
  this.submit();
  
  
}

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("form").addEventListener('submit', validarFormulario); 
});


function validar() {
  // Obtener nombre de archivo
  let archivo = document.getElementById('file').value;
  console.log(archivo)
  // Obtener extensión del archivo
      extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
  // Si la extensión obtenida no está incluida en la lista de valores
  // del atributo "accept", mostrar un error.
  if(document.getElementById('file').getAttribute('accept').split(',').indexOf(extension) < 0) {
    alert('Archivo inválido. No se permite la extensión ' + extension);
  }
}
</script>

@endsection