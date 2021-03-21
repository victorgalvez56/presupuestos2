@extends('adminlte::page')

@section('title', 'Presupuestos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reportes Presupuestos</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Presupuestos</li>
                    <li class="breadcrumb-item active">Reportes</li>

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
                    <form method="post" action="{{ route('reports.show_by_year') }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="year">
                                @foreach ($years as $year)
                                <option value="<?php echo $year->year;?>" <?php echo  $year->year == $year_selected ? "selected":"";?>><?php echo $year->year;?></option>
                                @endforeach
                            </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Ver!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            @if (!empty($budget))
                <div class="col-sm-4">
                    <div class="callout callout-info">
                        <h5> Total Presupuesto Soles:</h5>
                        <div class="input-group input-group-sm">
                            <h2><b> S/{{ $budget->total_budget_soles }} </b></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="callout callout-info">
                        <h5> Total Presupuesto Dolares:</h5>
                        <div class="input-group input-group-sm">
                            <h2><b> $/{{ $budget->total_budget_dollar }} </b></h2>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Meses</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach ($months as $month)
                                <li class="nav-item active">
                                    <a class="nav-link {{$month->selected}}"
                                        href="{{ route('reports.show_by_year_month', ['year' => $year_selected, 'month' => $month->name]) }}">{{ $month->name }}</a>
                                    </ </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Áreas</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach ($areas as $area)
                                <li class="nav-item active">
                                    <a class="nav-link {{$area->selected}}"
                                        href="{{ route('reports.show_by_year_month_area', ['area'=>$area->name, 'year' => $year_selected, 'month' => $month_selected]) }}">{{ $area->name }}</a>
                                    </ </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3 name_months">{{$year_selected. " | ". $month_selected. " | ". $area_selected}} </h3>
                        <ul class="nav nav-pills ml-auto p-2">
                        </ul>
                    </div>
            
                </div>

            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

<script>

</script>

@section('footer')
    @include('layouts.footer')
@stop

<script>

</script>
