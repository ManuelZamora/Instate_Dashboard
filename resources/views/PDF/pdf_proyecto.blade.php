<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proyecto</title>

    <link rel="stylesheet" href="tabla.css">
</head>
<style>
    body{
        font-family: SourceSansPro-Light;
    }
    footer {
        position: fixed;
        left: 0px;
        bottom: 0px;

        bottom: 0px;
        right: 0px;
        height: 40px;
        border-top: 2px solid #ddd;
    }

    footer .page:after {
        content: counter(page);
    }

    footer table {
        width: 100%;
    }

    footer p {
        text-align: right;
    }

    footer .izq {
        text-align: left;
    }

    .tables {
        border-collapse: collapse;
        width: 100%;
    }

    @page {
        font-family: SourceSansPro-Light;
    }


    @page :first {
        margin: 0px;
        margin-bottom: 0px;
        padding: 0px;
        background: url("{{asset('img/img_pdf1_portada.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }

    @page: first {
        position: fixed;
        left: 0px;
        bottom: 0px;

        bottom: -30px;
        right: 0px;
        height: 40px;
        border-top: 2px solid blue;

    }

    body {}

    @page :last-child {
        background-color: black;
    }

    .a {
        width: 793px;
        height: 1122px;

        background-color: red;


    }

    .portada {
        position: absolute;
        background: url("{{asset('img/img_pdf2_portada.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        top: -1px;
        width: 20px;
        height: 20px;
        left: -1px;
        width: 794px;
        height: 1123px;
    }

    .info {
        display: flex;

    }
    .pfinfo {
        display: flex;

    }

    .dor {
        padding: 50px;
    }

    .datos {
        font-family:Arial, Helvetica, sans-serif;
        display: inline;
        font-weight: lighter;
        color: white;
        font-size: 50px;

    }.datos2 {
        font-family:Arial, Helvetica, sans-serif;
        display: inline;
        font-weight: lighter;
        color: white;
        font-size: 28px;


    }.datos3 {
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color: white;


    }
    .datosT{ font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:#004cff;

        font-size: 50px;
    }
    .datosT-1{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:#004cff;

    }
     .datosT-2{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:#004cff;
        font-size: 35px;

    }

    .mr {
        font-size: 20px;
    }.mr2 {
    }

    .tipo {
        margin-top: 800px;
        height: 100px;
        display: inline-block;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;


    }
    .tipo2 {
        margin-top: 680px;
        height: 120px;
        display: inline-block;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
        font-size: 19px;


    }
    .pftipo {
        margin-top: 500px;
        height: 100px;
        text-align: center;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:white;


    }
    .pffo {
        border-top: 2px solid #ddd;
        margin-top: 500px;
    }

    .pffo .izq {
        float: left;
    }

    .pffo .dere {
        float: right;
    }

    .tipo .izq {
        float: left;
    }

    .tipo .dere {
        float: right;
    }



    .infos {
        margin: 0px;
        padding: 0px;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }

    .fo {
        border-top: 2px solid #ddd;
        margin-top: 30px;
    }

    .fo .izq {
        float: left;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        color: #939393;
    }

    .fo .dere {
        float: right;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        color: #939393;
    }



    .ims {
        margin-top: 100px;
        width: 400px;
        height: 300px;
        margin-left: -100px;
    }

    .ppag2 {
        position: absolute;
        background: url("{{asset('img/img_pdf2_ai.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        top: 0px;
        left: 0px;
        width: 793px;
        height: 1122px;
    }
    .pfinal {
        position: absolute;
        background: url("{{asset('img/img_pdf2_final.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;


        width: 794px;
        height: 1123px;

        top:-46px;
        left: -46px;

    }

    .manifiesto {
        margin-top: 100px;
    }
    .tmani{
        display: inline-block;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
    }
    .pag_obser{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
        width: 100%;
        height: 550px;
    }

    .pag4_datos {
        margin-top: 40px;
    }

    .pag4_datos h4,
    h2,
    h3 {
        display: inline;
    }

    .pag2_cu1 {
        margin-top: 50px;
        display: inline-block;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;

    }
    .pag2_cu1 .h_1{
        color:dimgray;
    }.pag2_cu1 .h_2{
        color:darkgrey;
    }


    .pag2_cu1 h3 {
        display: inline;
    }


    .pag4_tabla {
        margin-top: 10px;


    }

    .pag4_tabla .pag4_tab_izq {
        position: absolute;
        width: 49%;
        height: 210px;

    }

    .pag4_tabla .pag4_tab_der {
        position: absolute;
        width: 49%;
        height: 210px;
        float: right;
    }

    .img_cort {
        width: 100%;
    }

    .pag5_fot {
        margin-top: 25px;


    }

    .pag5_fot .pag5_fot_izq {
        position: absolute;
        width: 23%;
        height: 210px;

    }

    .pag5_fot .pag5_fot_der {
        position: absolute;
        width: 75%;
        height: 210px;
        float: right;
        border-left: 2px solid black;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;

    }

    .fot_top {
        width: 100%;
        padding-left: 20px;

        border-bottom: 2px solid black;
    }

    .fot_bottom {
        padding-left: 20px;
        width: 100%;
    }

    .pag6_foto {
        width: 100%;
        height: 350px;
        border-radius: 30px;
    }

    .pag6_fotos {
        width: 100%;
        height: 350px;
    }

    .foto_dere {
        position: absolute;
        width: 49%;
    }

    .foto_izq {

        position: absolute;
        width: 49%;
        float: right;
    }

    .foto_pie {
        margin-top: 30px;
        width: 100%;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
    }

    .pag6_datos {
        width: 100%;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
        display: flex;
        flex-flow: row wrap;
    }

    .pag6_dato1 {
        width: 25%;
        float: left;

 margin-right: 10px;

    }

    .pag6_dato2 {

        width: 25%;
        float: left;
 margin-right: 10px;
    }

    .pag6_dato3 {

        margin-right: 10px;
        width: 25%;
        float: left;
    }
    .pag6_dato4 {
        margin-right: 10px;
        width: 25%;
        float: left;
    }
    .fecha{
        color: #004cff;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }
    .pag4_h{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
    }
    .cu1_2{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
    }
    .cu1_2{
        margin-top: -2px;
        font-size: 15px;
    }

    .datos_pie {
        font-size: 10px;
        margin-top: -5px;
    }
    .pfdre{
        text-align: center;
        margin-top: 350px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:white;
    }
    .variables{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:#004cff;
        font-size: 25px;
    }
    .valores{
        font-family:Arial, Helvetica, sans-serif;
        font-weight: lighter;
        color:dimgray;
    }
    li{
        margin-top: 8px;
    }
    .tit{
        color: #004cff;
        font-size: 100%;
    }
    .rendi{
        color:yellowgreen;
    }
    .moreLighter{
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }
    .subrayado{
        text-decoration: underline;
        color:dimgray;
        border-bottom: 10px;
    }
    .Tipos{
        column-count: 3;
    }
</style>

<body>
    <footer>
        <table class="tables">
            <tr>
                <td>
                    <p class="izq">
                    <h6 class="infos" style="color:#939393">INSTATE©2021</h6>
                    </p>
                </td>
                <td>
                    <p class="moreLighter" style="color:#939393">

                        instate.com.mx

                    </p>
                </td>
            </tr>
        </table>
    </footer>
    <div class="portada">


        <div class="info">
            <div class="dor">
                <div>
                    <h1 class="datos">instate<sup class="mr">®</sup>investment</h1>
                    <br>
                </div>
                <div class="tipo">
                    <div class="izq">
                        <h3 class="datos2">Proyección Instate<sup class="mr2">®</sup></h3>
                    </div>
                    <div class="dere">
                        <h3 class="datos3">Diagnostico de uso de suelo y oportunidades
                            <br>
                            de negocio inmobiliario personalizado.
                        </h3>
                    </div>

                </div>
                <div class="fo">
                    <div class="izq">
                        <h6 class="moreLighter">INSTATE©2021</h6>
                    </div>
                    <div class="dere">
                        <h6>instate.com.mx</h6>
                    </div>
                </div>





            </div>


        </div>
    </div>




    <div style="page-break-before: always;"></div>
    <div class="ppag2">


        <div class="info">
            <div class="dor">
                <div>
                    <h1 class="datosT">Ai Instate</h1>
                    <br>
                </div>
                <div class="tipo2">
                    <h2>Hola, soy INSTATE, la primera Inteligencia Artificial
                        que detecta, diseña y planea oportunidades de
                        negocio inmobiliario con tan solo conocer la ubicación
                        de un terreno en México</h2>

                </div>
                <div class="fo">
                    <div class="izq">
                        <h6 class="">INSTATE©2021</h6>
                    </div>
                    <div class="dere">
                        <h6>instate.com.mx</h6>
                    </div>
                </div>





            </div>


        </div>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="pag3">
        <h1 class="datosT">Manifiesto</h1>
        <div class="manifiesto">
            <h1 class="tmani">Mis creadores me han alimentado de la mayor base
                de datos de proyectos residenciales y comerciales en
                el país, por lo que conozco las posibilidades de uso de
                suelo, precios de compra y venta para los principales
                giros y las características de los más comunes
                proyectos arquitectónicos que existen actualmente.
                Con esa información, al decirme dónde está un
                terreno, puedo darte las posibilidades de uso de suelo
                que tiene, sus mejores opciones de desarrollo y su
                potencial rendimiento de inversión en menos de 24
                horas. Además puedo generar el modelo de negocio y
                su proyecto ejecutivo en 72 horas adicionales.</h1>
        </div>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="pag4">
        <h1 class="datosT-1">Viabilidad de uso de suelo</h1>

        <h4 class="pag4_h">Según en Plan de Desarrollo del Municipio de {{$ciudad}} actualizado al <a class="fecha">{{$fecha}}</a>   </h4>
        <h4 class="pag4_h">Propiedad: <a class="fecha">{{$propiedad}}</a></h4>
        <div class="mapa">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$lat}},{{$lng}}&zoom=15&&maptype=hybrid&markers=color:blue%7Clabel:S%7C25.5448252,-103.443094&size=350x150&scale=2&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA" />
        </div>
        <div class="pag4_datos">
            <div class="cu1">
                <h2 class="fecha">CU1 / </h2>
                <h4 class="cu1_2">{{$tpsuelo}}</h4>
                <br>
                <hr>
            </div>
            <div class="pag2_cu1">
                <h3 class="h_1">DENSIDAD: </h3>
                <h3 class="h_2">{{$densidad}}</h3> <br> <br>
                <h3 class="h_1">PORCENTAJE DE ÁREA MULTIFAMILIAR: </h3>
                <h3 class="h_2"> {{$pam}}</h3> <br><br>
                <h3 class="h_1">LOTE MÍNIMO MULTIFAMILIAR: </h3>
                <h3 class="h_2"> {{$lote}}</h3> <br><br>
                <h3 class="h_1">CAJONES DE ESTACIONAMIENTO: </h3>
                <h3 class="h_2">{{$cajones}}</h3><br>
            </div>
            <hr>
        </div>
        <div class="pag4_tabla">



            <div class="pag4_tab_izq">
                <h3 class="variables">USOS VIABLES</h3>
                <hr>
                <ul>
                    @forelse($viables as $v)
                    <li>
                        <h3 class="valores"> {{$v}}</h3>
                    </li>
                    @empty
                    @endforelse

                </ul>
            </div>
            <div class="pag4_tab_der">
                <h3 class="variables">USOS CONDICIONADOS</h3>
                <hr>
                <ul>
                @forelse($condicionados as $c)
                    <li>
                        <h3 class="valores"> {{$c}}</h3>
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>

        </div>
    </div>


    <div style="page-break-before: always;"></div>

    <div class="pag5">

        <h1 class="datosT-2">Observaciones y Consejos INSTATE</h1>
        <div class="pag_obser">
            <h1>{{$observaciones}}</h1>
        </div>
        <br>
        <div class="pag5_fot">
            <div class="pag5_fot_izq">

                <img class="img_cort" src="{{asset('img/captura1.png')}}" alt="">
            </div>
            <div class="pag5_fot_der">
                <div class="fot_top">
                    <h4>Observamos que en el terreno se encuentra 20 cm bajo el nivel de
                        pavimento.</h4>
                </div>
                <div class="fot_bottom">
                    <h4>Te sugerimos hacer la contratación de un estudio topográfico para verficar
                        los niveles del terreno y poder corregir cualquier anomalía que se presente
                        en él.
                        Así mismo acudir al registro público de la propiedad para conocer si dicho
                        inmueble cuenta con libertad de gravamen, no se encuentra intestada o con
                        doble escrituración.</h4>
                </div>
            </div>
        </div>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="pag6">
        <h1 class="datosT-1">Oportunidades de Negocio</h1>
        <br>
        <div class="pag6_fotos">
            <div class="foto_dere">

                <img class="pag6_foto" src="{{asset('img/img_prueba_foto2.jpg')}}" alt="">

            </div>
            <div class="foto_izq">

                <img class="pag6_foto" src="{{asset('img/img_prueba_foto1.jpg')}}" alt="">
            </div>
        </div>
        <div style="clear: left; width: 100%; height: 1px;"></div>
        <div class="foto_pie">
            <h2 style="width: 100%;">Al estudiar tu propiedad, su ubicación y precios de compra y venta, hoy sabemos que las mayores oportunidades de negocio desarrollando este terreno están en: </h2>
        </div>
        <br>
        <hr>

        <div style="clear: left; width: 100%; height: 20px;"></div>

        <div class="pag6_datos">
            <div class="pag6_dato1">
                <div class="pag6_datos1_dato">
                    <h3 class="tit"> NAVE INDUSTRIAL</h3>
                    <br> <br> <br>
                    <div class="d">
                        <h3 style="font-size:20px">$9,000,000.00</h3>
                        <hr style="margin-top:-2px;">
                        <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                        <h3 style="font-size:20px">$10,000,000.00</h3>
                        <hr style="margin-top:-2px">
                        <p class="datos_pie">COSTO APROXIMADO DEL DESARROLLO</p>
                        <h3 class="rendi" style="font-size:20px">$10,000,000.00</h3>
                        <hr style="margin-top:-2px">
                        <p class="datos_pie">RENDIMIENTO ESPERADO</p>
                    </div>
                </div>
            </div>
            <div class="pag6_dato2">
                <h3 class="tit"> PLAZA COMERCIAL</h3>
                <br> <br> <br>
                <div class="d">
                    <h3 style="font-size:20px">$4,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                    <h3 style="font-size:20px">$8,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL DESARROLLO</p>
                    <h3 class="rendi" style="font-size:20px">$30,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">RENDIMIENTO ESPERADO</p>
                </div>
            </div>
            <div class="pag6_dato3">
                <h3 class="tit" style=""> TORRE DEPARTAMENTOS</h3>
                <br> <br>
                <div class="d">
                    <h3 style="font-size:20px">$800,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                    <h3 style="font-size:20px">$4,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                    <h3 class="rendi" style="font-size:20px">$16,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">RENDIMIENTO ESPERADO</p>
                </div>
            </div>
            <div class="pag6_dato4">
                <h3 class="tit" style=""> CASAS</h3>
                <br> <br><br>
                <div class="d">
                    <h3 style="font-size:20px">$800,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                    <h3 style="font-size:20px">$4,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">COSTO APROXIMADO DEL TERRENO</p>
                    <h3 class="rendi" style="font-size:20px">$16,000,000.00</h3>
                    <hr style="margin-top:-2px">
                    <p class="datos_pie">RENDIMIENTO ESPERADO</p>
                </div>
            </div>
        </div>
    </div>

    <div style="page-break-before: always;"></div>
<div class="pfinal">
<div class="pinfo">
            <div class="dor">

                <div class="pftipo">
                <h1 class>INSTATE©2021</h1>

                </div>
                <div class="pfdre">
                    <h3>instate.mx</h3>
                    <br>
                    <h6>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</h6>
                </div>





            </div>


        </div>
</div>
</body>

</html>
