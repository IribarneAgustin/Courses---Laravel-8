@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h1>Clases desactivadas</h1>
<br>
@stop

@section('content')
<div class="content">
    <table id="courses" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col" style="width: 5%">Id</th>
                <th scope="col" style="width: 10%">Nombre</th>
                <th scope="col" style="width: 5%">Descripción</th>
                <th scope="col" style="width: 10%">Imagen</th>
                <th scope="col" style="width: 10%">Precio</th>
                <th scope="col" style="width: 10%">Dias y horarios</th>
                <th scope="col" style="width: 10%">Link de clase virtual</th>
                <th scope="col" style="width: 10%">Link de archivos</th>
                <th scope="col" style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            @if ($course->isActive == 0)
            <tr>
                <td> {{$course->id}} </td>
                <td> {{$course->name}} </td>
                <td> {{$course->description}} </td>
                <td> <img src="{{asset($course->flyer)}}" width="100%" height="auto"></td>
                <td> {{$course->price}} </td>
                <td> {{$course->schedule}} </td>
                <td> {{$course->link}} </td>
                <td> {{$course->file}} </td>
                <td>
                    <form action="/activate" method="get" class="delete-form">
                        <a href="/courses/{{$course->id}}/edit" style="width: 40%" class="btn btn-info">Editar</a>
                        @csrf
                        <input type="hidden" name="courseId" value="{{ $course->id }}">
                        <button type="submit" class="btn btn-success" style="width: 40%">
                            Activar!</button>
                    </form>

                </td>
            </tr>
            @endif
            @endforeach

        </tbody>

    </table>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<!--Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Datatables -->
<script>
    $('#courses').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontró ningún registro",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                'next': "Siguiente",
                'previous': "Anterior"
            }
        }

    });
</script>

<script>
    $('.delete-form').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Desea activar esta clase?',
            text: " ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'Canelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })

    });
</script>
@stop