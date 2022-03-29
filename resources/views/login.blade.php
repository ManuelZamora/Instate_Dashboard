<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Design Lab Construccion</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor1/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        .contenedor {
            margin-top: 5%;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center contenedor">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <!--aqui inicia la carta -->
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <!--el body de la carta -->
                    <div class="card-body p-0">
                        <!-- crear row en la carta -->
                        <div class="row">
                            <!--imagen aqui se divide la imagen -->
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <!-- cierre de imagen-->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Design Lab Construccion</h1>
                                    </div>
                                    <form class="user">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for=" card-title">Correo:</label>
                                            <input type="email" class="form-control" id="correo" name="usuario" aria-describedby="emailHelp" placeholder="Correo">
                                        </div>
                                        <div class="form-group">
                                            <label for=" card-title">Contraseña</label>
                                            <input type="password" class="form-control" id="pass" name="contrasena" placeholder="Contraseña">
                                        </div>
                                        <button type="button" class="btn btn-primary btn-user btn-block btnin" id="btnin"> Ingresar</button>
                                        <hr>
                                        <div id="notifiacion" class="offset-1 col-md-9 text-center"></div>

                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor1/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor1/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor1/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>
<script>
    $(document).ready(function() {
        $('#btnin').click(function() {
            $('#alerta').remove();
            var usuario = $('#correo').val();
            var password = $('#pass').val();
            token = $("input[name = '_token']").val();
            err = "";
            contenido = $('#notifiacion');
            $.ajax({ 
                data: {
                    usuario: usuario,
                    password: password,
                    _token: token
                },
                datatype: 'JSON',
                type: 'post',
                url: '/getsesion',
                success: function(response) {
                    console.log(response);

                    if (response.respuesta == 1) {
                        location.href = '/bienvenido';
                    } else {
                        err = "<div id='alerta' class='alert alert-danger'>" + response.Mensaje + "</div>";
                        contenido.append(err);
                    }

                }
            });

        });

    });
</script>

</html>