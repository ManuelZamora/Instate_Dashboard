@extends('template.basedash')

@section('cssextra')


@endsection

@section('content')

<div class="container-fluid">


    <!-- Paginacion -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Contentenedor -->
    <div class="row justify-content-center">
        <div class="col-lg-6 align-self-center">

            <!-- carta -->
            <div class="card mb-4 r">
                <div class="card-header">
                    Bienvenido {{$usuarios['personas']->nombre}}
                </div>
                <div class="card-body">
                    Bueno dia "nombre de la persona" no olvides sonreir y que la vida te ilumine :D
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        console.log(session)
    });
</script>
@endsection