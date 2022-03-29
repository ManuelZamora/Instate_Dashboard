<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            width: 1000px;
            height: 1289px;
        }
        .container{
            background: red;
            column-count: 2;
            font-family: Arial, Helvetica, sans-serif;
            color:aliceblue;
            width: 1000px;
            height: 1289px;
        }
        .datos{
            font-weight: lighter;
            padding-top: 30px;
        }
        .proyecto{
            font-size: 14px;
        }
        .datos{
            font-weight: lighter;
        }
        .precio{
            padding-top: 20px;
            font-size: 35px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="">
                <div style="margin-top: 50px; margin-left: 20px; background:instate.com.mx/wp-content/uploads/2022/02/producto4_landing.png;">
                   <!-- <img src="https://instate.com.mx/wp-content/uploads/2022/02/producto4_landing.png" style="width:400px; "> -->
                </div>
                    <div>
                        <h1 class="datos">instate<sup class="mr" style="font-size: 15px;">®</sup>investment</h1>
                        <p>
                            ¿Estás listo para hacerlo realidad?
                            <br>
                        </p>
                        <p style="line-height: 20px; font-size: 13px">
                            A partir de patrones que he creado con mi base de datos de proyectos, puedo generar el Proyecto Ejecutivo <br> para desarrollar tu proyecto en meso deí 5 días.
                        </p>
                    </div>
                    <div>
                        <h4 class="proyecto">
                            Proyecto ejecutivo que contiene planos arquitectónicos, estructurales e instalaciones, renders y catálogo de conceptos en menos de 120 horas.
                        </h4>
                    </div>
                    <div>
                        <p style="line-height: 20px; font-size: 12px">
                            Todos nuestros proyectos son supervisados y  elaborados por grandes arquitectos y experimentados ingenieros, los proyectos INSTATE cumplen con <br> los máximos estándares nacionales e internacionales, ya que son elaborados a detalle como joyas Arquitectónicas Atemporales.
                        </p>
                    </div>
                    <div>
                        <p class="precio" style="text-align: center;">
                           {{$total}}
                        </p>
                    </div>
            </div>

        </div>
    </div>
</body>
</html>
