@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h1>Agregar curso</h1>
@stop

@section('content')
<form action="\courses" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input name="name" type="text" class="form-control" id="exampleInputEmail1" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Descripción</label>
        <textarea name="description" type="text" class="form-control" id="exampleInputPassword1" required></textarea>
    </div>
    <div class="form-group">
        <label class="form-label" for="customFile">Imagen</label>
        <input name="flyer" type="file" class="form-control" id="customFile" accept="image/*" required />
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Precio</label>
        <input name="price" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Días y Horarios</label>
        <input name="schedule" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Link del almacenamiento de archivos (Google drive)</label>
        <input name="file" type="file" class="form-control" id="customFile" accept=""/>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Link para clases virtuales</label>
        <input name="link" type="text" class="form-control" id="exampleInputPassword1" required>
    </div>

    <br>

    <br>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="/courses" class="btn btn-danger">Cancelar</a>
    </div>



</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop