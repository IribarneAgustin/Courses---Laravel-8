@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h1>Mis alumnos</h1>
<br>
@stop

@section('content')
<div class="content">
    <table id="students" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col" style="width: 5%">Id</th>
                <th scope="col" style="width: 10%">Nombre</th>
                <th scope="col" style="width: 10%">Email</th>
                <th scope="col" style="width: 10%">Cursos en los que se encuentra inscripto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td> {{$student['user']->id}} </td>
                <td> {{$student['user']->name}} </td>
                <td> {{$student['user']->email}} </td>
                <td>
                    @foreach ($student['courses'] as $courses )
                    {{$courses->name }} <br>
                    @endforeach
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
</div>


@stop