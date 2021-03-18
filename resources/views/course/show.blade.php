@extends('layouts.plantillabase')

@section('contenido')

<body id="page-top">

    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Clases en las que se encuentra inscripto</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row">

                @foreach ($courses as $course)

                <div class="col-md-6 col-lg-4" style="padding:10px">
                    <div class="card border-0">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light">
                            <a class="lightbox" href=""><img src="{{$course->flyer}}" class="card-img-top">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                            </a>
                            <div class="card-body">
                                <div class="text-center">
                                <h6><b>{{$course->name}}</b></h6>
                                <p>Recuerde que las clases se dictarán los {{$course->schedule}}</p>
                                    <form action="/showClass" method="get">
                                        @csrf
                                        <input type="hidden" name="courseId" value="{{ $course->id }}">
                                        <button type="submit" class="btn btn-primary">
                                            Ingresar!</button>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach
    </section>


</body>


@stop