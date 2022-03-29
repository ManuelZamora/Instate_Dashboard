<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Estudio de Mercado</title>

    <link rel="stylesheet" href="tabla.css">
</head>
<style>

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
        font-family:'Source Sans Pro', sans-serif;
    }

    .tables {
        border-collapse: collapse;
        width: 100%;
    }

    @page {}

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

    body {
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }

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
        background: url("{{asset('img/img_pdf1_portada.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        top: 0px;
        width: 20px;
        height: 20px;
        left: 0px;
        width: 793px;
        height: 1122px;
    }

    .info {
        display: flex;

    }

    .dor {
        padding: 50px;
    }

    .datos {

        display: inline;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        font-size: 35px;
    }

    .mr {
        font-size: 20px;
    }

    .tipo {
        margin-top: 800px;
        height: 100px;
        display: inline-block;


    }

    .tipo .izq {
        float: left;
    }

    .tipo .dere {
        float: right;
        font-family:'Source Sans Pro', sans-serif;
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
    }

    .fo .dere {
        float: right;
    }


    .pag3_head {
        display: block;
    }

    .pag3_head .infiz {}


    .head2 {}

    .head2 .infiz {
        float: left;
    }

    .head2 .infder {
        float: right;
        font-family:'Source Sans Pro', sans-serif;
    }

    .char {
        width: 100%;
    }

    .ims {
        margin-top: 20px;
        width: 100%;
        height: 300px;
    }

    .pag2_tabla {}

    .pag_tabla {
        width: 100%;
        margin-top: 20px;
    }

    .pag4_tablas {
        width: 100%;
    }

    table {
        background-color: white;
        text-align: left;
        border-collapse: collapse;
        width: 100%;
    }

    th {
        padding-bottom: 10px;
        border-bottom: solid 1px grey;
    }

    .ctd {
        padding-bottom: 5px;
        border-bottom: solid 1px grey;
        opacity: 0.5;
    }


    thead {
        border-bottom: solid 1px #0F362D;


    }

    td :first {
        padding-top: 10px;
    }

    tr:nth-child(even) {
        background-color: #ddd;
    }

    .tizq {
        text-align: right;
        font-weight: lighter;
        color: #333333;

    }

    .tder {
        text-align: left;
        font-weight: lighter;
        color: #333333;
    }

    .infotop {
        width: 100%;
        border-bottom: solid 2px #0F362D;
        padding: 10px;

        margin-top: 20px;
    }

    .infomid {
        width: 100%;
        border-bottom: solid 2px #0F362D;
        padding: 10px;
        margin-top: 20px;
    }

    .it1 {
        width: 32%;
        display: inline-block;
        vertical-align: middle;

        border-right: solid 2x #0F362D;
    }

    .it2 {
        width: 32%;
        display: inline-block;
        vertical-align: middle;


        border-right: solid 2px #0F362D;

    }

    .it3 {
        width: 32%;
        display: inline-block;
        vertical-align: middle;
    }

    .it1 h2,
    h3 {
        display: inline-block;
        font-size: 100%;
    }

    .it2 h2,
    h3 {
        display: inline-block;
        font-size: 100%;
    }

    .it3 h2,
    h3 {
        display: inline-block;
        font-size: 100%;
    }

    .infobot {
        width: 100%;
        margin-top: 5px;
        vertical-align: middle;
        margin-top: -10px;
        padding-top: 0;
    }

    .ib1 {

        float: left;
        width: 65%;
        vertical-align: middle;
        margin-top: -10px;
        padding-top: 0;
    }

    .ib1 h2 {}

    .ib2 {
        float: left;
        width: 25%;
        margin-left: 5%;
        padding-top: 35px;
        vertical-align: middle;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        font-size: 10px;
    }

    .datos_img {
        width: 100%;
        margin-top: 20px;
    }

    .daots_img_izq {
        float: left;
        width: 48%;
        margin-right: 5px;

    }

    .daots_img_der {
        width: 48%;
        float: left;
        margin-left: 5px;
    }

    .img_circ {
        width: 80%;
    }

    .dato_izq_img {

        text-align: left;
        padding-left: 15px;
    }

    .dato_der_img {
        text-align: right;
        padding-right: 55px;
    }

    .color_tabs {
        margin-top: 22px;
        height: 360px;
        width: 100%;
    }

    .tab_ubi_td {}

    .tok_img {
        height: 25px;
    }

    .th_tablas {

        border-bottom: solid 1px #0F362D;
        font-weight: lighter;
    }

    .pfinal {
        position: absolute;
        background: url("{{asset('img/img_pdf1_final.jpg')}}") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

        text-align: center;
        width: 794px;
        height: 1123px;

        top: -46px;
        left: -46px;

    }
    .dori{
        text-align: center;
        padding: 70px;
    }
    .pinfo {
        text-align: center;
    }

    .pftipo {
        margin-top: 450px;
        height: 100px;
        text-align: center;
        font-family: 'Source Sans Pro', sans-serif;
        font-weight: lighter;


    }

    .pfdre {
        text-align: center;
        margin-top: 350px;
        font-family: 'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }
    .imagenes_calor{
        text-align: center;
    }
    .mcalor{
        margin-top: 50px;
        width: 100%;
        height: 550px;
    }
    .barcolor{
        margin-top: 100px;
    }
    .mainBlueColor{
        color: #004cff;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        font-size: 23px;
    }
    .h3-Absorcion{
        color: #004cff;
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        font-size: 20px;
    }
    .moreLighter{
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
    }
    .moreLighter-th{
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        text-align: right;

    }
    .moreLighter-th-ubi{
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        text-align: left;
    }
    .price{
        font-family:'Zen Kurenaido', sans-serif;
        font-weight: lighter;
        font-size: 25px;
        opacity: 0.7;
    }
    .moreLighter-number{
        font-family:'Source Sans Pro', sans-serif;
        font-weight: lighter;
        opacity: 0.8;
        font-size: 25px;
        margin-top: 2px;
        padding:0px;
    }
</style>




<body>
    <footer>
        <table class="tables">
            <tr>
                <td>
                    <p class="izq">
                    <h6 class="infos">INSTATE©2021</h6>
                    </p>
                </td>
                <td>
                    <p>

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
                        <h3>ESTUDIO DE MERCADO <br>
                            INMOBILIARIO.</h3>
                    </div>
                    <div class="dere">
                        <h3>Interpolación de precios de compra y venta<br>
                            en la zona (a 1.2km de radio). </h3>
                    </div>

                </div>
                <div class="fo">
                    <div class="izq">
                        <h6 class="">INSTATE©2021</h6>
                    </div>
                    <div class="dere">
                        <h6>INSTATE.COM.MX</h6>
                    </div>
                </div>





            </div>


        </div>
    </div>




    <div style="page-break-before: always;"></div>

    <div class="pag2">
        <div class="head2">
            <div class="infiz">
                <p class="mainBlueColor">CASAS EN VENTA <br>
                    -------- {{$Tubi}}</p>
            </div>
            <div class="infder">
                <p class="moreLighter" style="color: #333333">PRECIO TOTAL <br>
                    &nbsp;POR COLONIA</p>
            </div>
        </div>

        <div style="clear: left; width: 100%; height: 1px;"></div>
        <div class="char">
            <img class="ims" src="{{$link}}">
        </div>

        <div style="clear: left; width: 100%; height: 1px;"></div>
        <div class="pag_tabla">
            <table class="pag2_tabla">
                <thead class="th_tabla">
                    <tr>
                        <th class="tder" style="font-size: 13px;">UBICACIÓN</th>
                        <th class="tizq" style="font-size: 13px;">PRECIO <br> PROMEDIO</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @forelse($ubi_costo as $v)
                    <tr>
                        <td class="tder ctd">{{$v['ubicacion']}}</td>
                        <td class="tizq ctd" style="font-size: 12px">{{$v['promedio']}}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>


            </table>

        </div>

    </div>

    <div style="page-break-before: always;"></div>
    <div class="pag3">
        <div class="pag3_head">
            <div class="infiz">
                <p class="mainBlueColor">CASAS EN VENTA <br>
                    -------- {{$Tubi}}</p>
            </div>

        </div>
        <div style="width: 100%;  margin-top: 10px;">
            <img style="width: 100%; height: 420px" src="{{$googlrapi}}" alt="">
        </div>
        <div class="datos_img">

            <div class="daots_img_izq">
                <div>
                    <h3 class="moreLighter" style="color:#333333; font-size:13px" >PRECIO PROMEDIO POR M2</h3>
                    <hr>
                </div>
                <div style="vertical-align: center; text-align: center;">
                    <div class="dato_izq_img">
                        <h4>{{$casamenor}}</h4>
                    </div>

                    <div>
                        <img class="img_circ" src="{{asset('img/circu.png')}}" alt="">
                    </div>
                    <div class="dato_der_img">
                        <h4>{{$casamayor}}</h4>
                    </div>
                </div>



            </div>
            <div class="daots_img_der">
                <div>
                    <h3 class="moreLighter" style="color:#333333; font-size:13px" >UBICACIÓN</h3>
                    <hr>
                </div>
                <div class="color_tabs">
                    <table class="t_ubi">
                        <tbody>
                            @forelse($ubicaciones_filtradas as $v => $ubi)
                            <tr>
                                <td class="tab_ubi_td"><img class="tok_img" src="https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|{{$ubi[1]}}" alt=""></td>
                                <td class="tab_ubi_td" style="color:#939393">{{$v+1}} {{$ubi['ubicacion']}}</td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div style="clear: left; width: 100%; height: 1px;"></div>
        </div>
        <div style="clear: left; width: 100%; height: 1px;"></div>
    </div>

    <!--<div style="page-break-before: always;"></div>
    <div class="pag3">
        <div class="pag3_head">
            <div class="infiz">
                <h4>CASAS EN VENTA <br>
                    -------- {{$Tubi}}</h4>
            </div>

        </div>
        <div style="width: 100%; margin-top: 10px;">
            <img style="width: 100%; height: 600px;" src="{{$googlrapi2}}" alt="">
        </div>
    </div> -->

    <div style="page-break-before: always;"></div>

    <div class="pag4">
        <div class="pag3_head">
            <div class="infiz">
                <h3 class="mainBlueColor">CASAS EN VENTA <br>
                    -------- {{$Tubi}}</h2>
            </div>

        </div>
        <div class="pag4_tablas">

            <table class="pag2_tabla">
                <thead class="th_tablas">

                    <tr style="font-size: 13px;">
                        <th class="moreLighter-th-ubi" style="color:#333333">UBICACIÓN</th>
                        <th class="moreLighter-th" style="color:#333333">PRECIO <br> PROMEDIO M2</th>
                        <th class="moreLighter-th" style="color:#333333">PRECIO <br> MAXIMO M2</th>
                        <th class="moreLighter-th" style="color:#333333">PRECIO <br> MINIMO M2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @forelse($ubi_costo as $v)
                    <tr class="moreLighter">
                        <td class="ctd">{{$v['ubicacion']}}</td>
                        <td class="ctd">{{$v['promedio']}}</td>
                        <td class="ctd">{{$v['mayor']}}</td>
                        <td class="ctd">{{$v['menor']}}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>



            </table>
        </div>
        <div class="pag4_info">
            <div class="infotop">
                <div class="it1">
                    <h2  class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
                <div class="it2">
                    <h2 class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
                <div class="it3">
                    <h2  class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
            </div>
            <div class="infomid">
                <div class="it1">
                    <h2 class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
                <div class="it2">
                    <h2 class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
                <div class="it3">
                    <h2 class="mainBlueColor">PRECIO PROMEDIO POR M2</h2> <br>
                    <h3 class="price">$52,449.51</h3>
                </div>
            </div>
            <div class="infobot">
                <div class="ib1">
                    <h3 class="h3-Absorcion">ABSORCIÓN APROX. DE PROPIEDADES AL MES</h3>
                    <h2 class="moreLighter-number">0,5</h2>
                </div>
                <div class="ib2">
                    <p style="color:#838383">LO QUE QUIERE DECIR QUE SE VENDEN APROXIMADAMENTE 6 PROPIEDADES AL AÑO.</p>
                </div>
            </div>
        </div>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="pag5">
    <div class="pag3_head">
            <div class="infiz">
                <h3 class="mainBlueColor">MAPA CONTORNO DE CALOR <br>
                PRECIO / M2</h3>
            </div>

        </div>
        <div class="imagenes_calor">
            <img class="mcalor" src="{{asset($mapacalor)}}" alt="">
            <img class="barcolor" src="{{asset('img/colorbar.jpg')}}" alt="">

        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <div class="pfinal">
        <div class="pinfo">
            <div class="dori">

                <div class="pftipo">
                    <h1 class="moreLighter">INSTATE©2021</h1>

                </div>
                <div class="pfdre">
                     <h2 class="moreLighter">instate.mx</h2>

                    <h6 class="moreLighter">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                        nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                        illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</h6>
                </div>





            </div>


        </div>
    </div>
</body>

</html>
