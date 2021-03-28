@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h1>Modificar curso</h1>
@stop

@section('content')
<form action="/courses/{{$course->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input value="{{$course->id}}" name="name" type="text" class="form-control" id="exampleInputEmail1" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Descripción</label>
        <textarea value="{{$course->description}}" name="description" type="text" class="form-control" id="exampleInputPassword1" required>{{$course->description}}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label" for="customFile">Imagen</label>
        <input value="{{$course->flyer}}" name="flyer" type="file" class="form-control" id="customFile" accept="image/*" />
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Precio</label>
        <input value="{{$course->price}}" name="price" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Días y Horarios (Por ej. Lunes y viernes 18hs)</label>
        <input value="{{$course->schedule}}" name="schedule" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Link del almacenamiento de archivos (Google drive)</label>
        <input value="{{$course->file}}"  name="file" type="text" class="form-control" id="customFile" accept="" required/>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Link para clases virtuales</label>
        <input value="{{$course->link}}" name="link" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>

    <br>

    <br>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Modificar</button>
        <a href="/courses" class="btn btn-danger">Cancelar</a>
    </div>



</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop