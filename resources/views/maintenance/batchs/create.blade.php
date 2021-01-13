@extends('adminlte::page')

@section('title','Áreas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Partidas</h1>
                <!--                    --><?php //if ($permisos->insert == 1) : ?>
            {{--                    <a href="<?php echo base_url(); ?>mantenimiento/areas/add" class="btn btn-primary btn-flat"><span--}}
            {{--                            class="fa fa-plus"></span>Agregar Área</a>--}}
            <!--                    --><?php //endif; ?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Partidas</li>
                    <li class="breadcrumb-item active">Agregar</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nueva partida</h3>
                    </div>
                    <form method="post" action="{{ route('batchs.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Área</label>
                                <select name="area_id" class="form-control" required>
                                    <option value="">Seleccione área</option>
                                    @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('footer')
    <p>Bienvenido a este template</p>
@stop
