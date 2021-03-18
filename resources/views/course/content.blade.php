@extends('layouts.plantillabase')


@section('contenido')


<body id="page-top">

    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Bienvenido a las clases de {{$course->name}}</h2>
            <hr>
            <div class="text-center">
                <p>Gracias por confiar en nosotros, aquí podrá acceder tanto al material como a las clases en vivo</p>
                <a class="btn btn-primary" target="_blank" href="{{$course->link}}"> Acceder a clase en vivo </a>
                <br>
                <br>
            </div>
            <div class="container" style="background-color:whitesmoke;padding:5px">
                <p>Días y horarios de las clases:<b> {{$course->schedule}} </b></p>
                <a class="btn btn-warning" target="_blank" href="{{$course->file}}"><i class="fa fa-download" aria-hidden="true"></i> Material descargable</a>
            </div>
        </div>
    </section>
</body>

@stop