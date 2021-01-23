@extends('adminlte::page')

@section('title', 'Presupuestos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Agregar Presupuestos</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Presupuestos</li>
                    <li class="breadcrumb-item active">Agregar</li>

                </ol>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-3">
                <div class="callout callout-info">
                    <h5> Años:</h5>
                    <form method="post" action="{{ route('show_by_year') }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="year">
                                @foreach ($years as $year)
                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

<script>

</script>

@section('footer')
    @include('layouts.footer_budgets')
@stop

<script>

</script>
