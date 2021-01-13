@extends('adminlte::page')

@section('title','Usuarios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuarios</h1>
                <!--                    --><?php //if ($permisos->insert == 1) : ?>
                <a href="{{ route('users.create')}}" class="btn btn-primary btn-flat"><span
                        class="fa fa-plus"></span>Agregar Usuario</a>
                <!--                    --><?php //endif; ?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                        <h3 class="card-title">Listado de Usuarios </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Actualización</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>

                                    <td>{{$user->name_rol}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    @if($user->status == 'available')
                                        <td>
                                            <a class="btn btn-success btn-sm">Disponible</a>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('users.edit',$user->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>

                                                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-lg" value="{{$user->id}}"
                                                            id="modalConfirmacion" data-toggle="modal"
                                                            data-target="#modal-default"><span
                                                            class="fas fa-user-times"></span>
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
                                                <a href="{{ route('users.edit',$user->id)}}"
                                                   class="btn btn-warning btn-lg"><span
                                                        class="fas fa-edit"></span></a>

                                                <form action="{{ url('users/enable/'.$user->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success btn-lg" value="{{$user->id}}"
                                                            id="modalConfirmacion" data-toggle="modal"
                                                            data-target="#modal-default"><span
                                                            class="fas fa-user-plus"></span>
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


