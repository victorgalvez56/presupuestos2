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
            @if(!empty($budget))
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
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{route('reports.show_by_year_month',['year'=>$year_selected, 'month'=> $month->name])}}"
                                        >{{ $month->name }}</a></ </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
           
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3 name_months">Seleccione un mes</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                        </ul>
                    </div>
     
                </div>
          
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('budgets.store') }}">
        @csrf
        <div class="modal fade show" id="modal_create_budgets" aria-modal="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="card-header">
                        <h3 class="card-title">Registrar presupuesto
                            <button type="button" class="btn btn-success" id="add_row_budgets"><span
                                    class="fas fa-plus"></span>
                            </button>
                        </h3>
                        <div class="card-tools">
                            <input type="number" id="price_dollar" name="price_dollar" class="form-control"
                                placeholder="$. 00.00" step=".01" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <table id="table_add_budgets" class="table table-bordered   table-striped table-hover">
                                        <thead>
                                            <tr id="row_head">
                                                <th>Mes</th>
                                                <th>Cantidad</th>
                                                <th>Descripción</th>
                                                <th>Rubro</th>
                                                <th>Precio Unitario</th>
                                                <th>Total S/.</th>
                                                <th>Total $/.</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="month_id[]" class="form-control" required>
                                                        <option value="">Seleccione área</option>
                                                        @foreach ($months as $month)
                                                            <option value="{{ $month->id }}">{{ $month->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="quantity[]" class="form-control quantity"
                                                        placeholder="Ingrese cantidad" step="0.1" min="0" required>
                                                </td>
                                                <td><textarea type="text" name="description[]" class="form-control"
                                                        placeholder="Ingrese descripción" required></textarea>
                                                </td>
                                                <td>
                                                    <select name="batch_id[]" class="form-control" required>
                                                        <option value="">Seleccione área</option>
                                                        @foreach ($batchs as $batch)
                                                            <option value="{{ $batch['id'] }}">{{ $batch['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="unit_price[]" class="form-control unit_price"
                                                        placeholder="S/. 00.00" step="0.01" min="0" required>
                                                </td>
                                                <td><input type="number" name="total_soles[]" class="form-control"
                                                        placeholder="S/. 00.00" step="0.01" min="0" required readonly>
                                                </td>
                                                <td><input type="number" name="total_dollars[]" class="form-control"
                                                        placeholder="$. 00.00" step="0.01" min="0" required readonly>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" id="delete_row_budgets"
                                                        data-target="#modal-default"><span class="fas fa-minus"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </form>
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
