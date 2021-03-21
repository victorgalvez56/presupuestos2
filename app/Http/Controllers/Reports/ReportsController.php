<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\BatchsModel;
use App\Models\Maintenance\MonthsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budgets\BudgetsModel;
use App\Models\Budgets\DetailsBudgetModel;
use App\Models\Maintenance\AreasModel;

class ReportsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $months = MonthsModel::all();
        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->select('batchs.*')
            ->get()->toArray();

        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();

        return view('reports.index', compact('months', 'years', 'batchs'));
    }



    public function show_by_year(Request $request)
    {
        $id = Auth::user()->id;
        $year_selected = $request->year;
        $months = MonthsModel::all();

        $budget = BudgetsModel::where('representative_id','=',$id)
        ->whereYear('created_at', '=', $year_selected)
        ->first();
        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->select('batchs.*')
            ->get()->toArray();
        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();



        return view('reports.show_by_year', compact('months', 'batchs', 'years', 'year_selected','budget'));
    }

    public function show_by_year_month($year_selected, $month_selected)
    {

        $id = Auth::user()->id;
        $id_month = MonthsModel::where('name', '=', $month_selected)->first();
        $months = MonthsModel::all();
        foreach($months as $month){
            if($month['id'] == $id_month->id){
                $month['selected'] ='active';
            }else{
                $month['selected'] = '';
            }
        }

        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->orderBy('name','asc')
            ->select('batchs.*')
            ->get()->toArray();

        $areas = AreasModel::where('status','=','available')->orderBy('name','asc')->get();    

        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();
        
        $budget = BudgetsModel::where('representative_id','=',$id)
        ->whereYear('created_at', '=', $year_selected)
        ->first();

        $details_budgets = DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
            ->join('months', 'months.id', '=', "details_budgets.month_id")
            ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
            ->where('budgets.representative_id', '=', $id)
            ->where('details_budgets.month_id', '=', $id_month->id)
            ->whereYear('details_budgets.created_at', '=', $year_selected)
            ->select('details_budgets.*', 'months.name as name_month', 'batchs.name as name_batch')
            ->get()->toArray();


            // $total_month = DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
            // ->join('months', 'months.id', '=', "details_budgets.month_id")
            // ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
            // ->where('budgets.representative_id', '=', $id)
            // ->where('details_budgets.month_id', '=', $id_month->id)
            // ->where('months.name', '=', $month_selected)
            // ->sum('details_budgets.total_soles','details_budgets.total_dollars');
            
            // dd($total_month);
        $details =  array_reduce($details_budgets, function ($accumulator, $item) {
            $index = $item['name_batch'];
            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'details' => []
                ];
            }
            $accumulator[$index]['details'][] = [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'description' => $item['description'],
                'unit_price' => $item['unit_price'],
                'total_soles' => $item['total_soles'],
                'total_dollars' => $item['total_dollars'],
            ];
            return $accumulator;
        }, []);


        // dd($details);

        return view('reports.show_by_year_month', compact('areas','months', 'month_selected', 'years', 'year_selected', 'batchs', 'details','budget'));
  
    }

    public function show_by_year_month_area($year_selected, $month_selected,$area_selected)
    {
        
        $id = Auth::user()->id;
        $id_month = MonthsModel::where('name', '=', $month_selected)->first();
        $id_area = AreasModel::where('name', '=', $area_selected)->first();
        $months = MonthsModel::all();
        foreach($months as $month){
            if($month['id'] == $id_month->id){
                $month['selected'] ='active';
            }else{
                $month['selected'] = '';
            }
        }
        $areas = AreasModel::where('status','=','available')->orderBy('name','asc')->get();    
        foreach($areas as $area){
            if($area['id'] == $id_area->id){
                $area['selected'] ='active';
            }else{
                $area['selected'] = '';
            }
        }

        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->select('batchs.*')
            ->get()->toArray();


        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();
        
        $budget = BudgetsModel::where('representative_id','=',$id)
        ->whereYear('created_at', '=', $year_selected)
        ->first();

        $details_budgets = DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
            ->join('months', 'months.id', '=', "details_budgets.month_id")
            ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
            ->where('budgets.representative_id', '=', $id)
            ->where('details_budgets.month_id', '=', $id_month->id)
            ->whereYear('details_budgets.created_at', '=', $year_selected)
            ->select('details_budgets.*', 'months.name as name_month', 'batchs.name as name_batch')
            ->get()->toArray();


            // $total_month = DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
            // ->join('months', 'months.id', '=', "details_budgets.month_id")
            // ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
            // ->where('budgets.representative_id', '=', $id)
            // ->where('details_budgets.month_id', '=', $id_month->id)
            // ->where('months.name', '=', $month_selected)
            // ->sum('details_budgets.total_soles','details_budgets.total_dollars');
            
            // dd($total_month);
        $details =  array_reduce($details_budgets, function ($accumulator, $item) {
            $index = $item['name_batch'];
            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'details' => []
                ];
            }
            $accumulator[$index]['details'][] = [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'description' => $item['description'],
                'unit_price' => $item['unit_price'],
                'total_soles' => $item['total_soles'],
                'total_dollars' => $item['total_dollars'],
            ];
            return $accumulator;
        }, []);

        return view('reports.show_by_year_month_area', compact('areas','area_selected','months', 'month_selected', 'years', 'year_selected', 'batchs', 'details','budget'));
  
    }
    
}


