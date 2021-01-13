@extends('adminlte::page')

@section('title','Áreas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Áreas</h1>
                <!--                    --><?php //if ($permisos->insert == 1) : ?>
                <a href="{{ route('areas.create')}}" class="btn btn-primary btn-flat"><span
                        class="fa fa-plus"></span>Agregar Área</a>
            <!--                    --><?php //endif; ?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Áreas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Áreas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Representante</th>
                                <th>Estado</th>
                                <th>Actualización</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($areas as $area)
                                <tr>
                                    <td>{{$area->name}}</td>
                                    <td>{{$area->name_representative}}</td>
                                    <td>{{$area->updated_at}}</td>
                                    @if($area->status == 'available')
                                        <td>
                                            <a class="btn btn-success btn-sm">Disponible</a>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('areas.edit',$area->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>

                                                <form action="{{ route('areas.destroy', $area->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-lg" value="{{$area->id}}"
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
                                                <a href="{{ route('areas.edit',$area->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>

                                                <form action="{{ url('areas/enable/'.$area->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success btn-lg" value="{{$area->id}}"
                                                            id="modalConfirmacion" data-toggle="modal"
                                                            data-target="#modal-default"><span
                                                            class="fas fa-plus-square"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif


                                    {{--                                            <td>--}}
                                    {{--                                                <a href="{{ route('areas.edit',$area->id)}}" class="btn btn-primary">Edit</a>--}}
                                    {{--                                                <form action="{{ route('areas.destroy', $area->id)}}" method="post">--}}
                                    {{--                                                    @csrf--}}
                                    {{--                                                    @method('DELETE')--}}
                                    {{--                                                    <button class="btn btn-danger" type="submit">Delete</button>--}}
                                    {{--                                                </form>--}}
                                    {{--                                            </td>--}}
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
