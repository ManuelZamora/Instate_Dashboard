@extends('template.basedash')

@section('cssextra')


@endsection

@section('content')

<div class="container-fluid">


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-lg-6 align-self-center">

            <!-- Default Card Example -->
            <div class="card mb-4 r">
                <div class="card-header">
                    Nombre de la persona
                </div>
                <div class="card-body">
                    Bueno dia "nombre de la persona" no olvides sonreir y que la vida te ilumine :D
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->



    <!-- Content Row -->



</div>






@endsection

@section('javascript')
<script>
    $(document).ready(function() {

    });
</script>
@endsection