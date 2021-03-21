@extends('adminlte::page')

@section('title','Partidas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Partidas</h1>
                <!--                    --><?php //if ($permisos->insert == 1) : ?>
                                <a href="{{ route('batchs.create')}}" class="btn btn-primary btn-flat"><span
                                        class="fa fa-plus"></span>Agregar Área</a>
            <!--                    --><?php //endif; ?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Partidas</li>
                </ol>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Partidas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Área</th>
                                <th>Actualización</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($batchs as $batch)
                                <tr>
                                    <td>{{$batch->name}}</td>
                                    <td>{{$batch->name_area}}</td>
                                    <td>{{$batch->updated_at}}</td>
                                    @if($batch->status == 'available')
                                        <td>
                                            <a class="btn btn-success btn-sm">Disponible</a>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('batchs.edit',$batch->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>

                                                <form action="{{ route('batchs.destroy', $batch->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-lg" value="{{$batch->id}}"
                                                            id="modalConfirmacion" data-toggle="modal"
                                                            data-target="#modal-default"><span
                                                            class="far fa-minus-square"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <a class="btn btn-danger btn-sm">Inhabilitado</a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('batchs.edit',$batch->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>
                                                <form action="{{ url('batchs/enable/'.$batch->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success btn-lg" value="{{$batch->id}}"
                                                            id="modalConfirmacion" data-toggle="modal"
                                                            data-target="#modal-default"><span
                                                            class="fas fa-plus-square"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
@section('js')
    @include('layouts.footer')
@endsection



