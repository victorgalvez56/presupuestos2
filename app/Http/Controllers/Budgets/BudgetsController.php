<?php

namespace App\Http\Controllers\Budgets;

use App\Http\Controllers\Controller;
use App\Models\Budgets\BudgetsModel;
use App\Models\Budgets\DetailsBudgetModel;
use App\Models\Maintenance\BatchsModel;
use App\Models\Maintenance\MonthsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Mod;

class BudgetsController extends Controller
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

        return view('budgets.index', compact('months', 'years', 'batchs'));
    }

    public function create()
    {
        echo "create";
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $price_dollar = $request->get('price_dollar');
        $total_soles = $request->get('total_soles');
        $total_dollars = $request->get('total_dollars');
        $month_id  = $request->get('month_id');
        $quantity  = $request->get('quantity');
        $description = $request->get('description');
        $batch_id  = $request->get('batch_id');
        $unit_price = $request->get('unit_price');
        $total_budget_soles = 0;
        $total_budget_dollar = 0;
        foreach ($total_soles as $soles) {
            $total_budget_soles = $total_budget_soles + $soles;
        }
        foreach ($total_dollars as $soles) {
            $total_budget_dollar = $total_budget_dollar + $soles;
        }
        $previous_budget = BudgetsModel::where('representative_id', '=', $id)
            ->whereYear('created_at', '=', date('Y'))
            ->first();


        if ( $previous_budget) {

            $total_soles_previously = $total_budget_soles + $previous_budget->total_budget_soles;
            $total_dollars_previously = $total_budget_dollar + $previous_budget->total_budget_dollar ;

            $previous_budget->total_budget_soles = $total_soles_previously;
            $previous_budget->total_budget_dollar = $total_dollars_previously;
            $previous_budget->save();

            $this->save_details_budget($previous_budget->id, $price_dollar, $month_id, $quantity, $description, $batch_id, $unit_price, $total_soles, $total_dollars);
        } else {
            $budget = new BudgetsModel([
                'total_budget_soles' => $total_budget_soles,
                'total_budget_dollar' => $total_budget_dollar,
                'representative_id' => Auth::id()
            ]);
            $budget->save();

            $this->save_details_budget($budget['id'], $price_dollar, $month_id, $quantity, $description, $batch_id, $unit_price, $total_soles, $total_dollars);


            if ($budget->save()) {
                return back()->with('success', 'Prespuesto Guardado!');
            } else {
                return back()->with('success', 'Prespuesto No Guardado!');
            }
        }
        return back()->with('success', 'Prespuesto Guardado!');
    }
    public function show(Batchs $batchs)
    {
        //
    }
    public function edit($id)
    {
        $roles = RolesModel::where('status', '=', 'available')->get();
        $user = User::find($id);
        return view('maintenance.users.edit', compact('roles', 'user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role_id');
        $user->save();
        return redirect('/users    ')->with('success', 'Usuario Actualizado!');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 'unavailable';
        $user->save();
        return redirect('/users')->with('success', 'Usuario Desactivado!');
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
            ->orderBy('batchs.name','asc')
            ->select('batchs.*')
            ->get()->toArray();
        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();



        return view('budgets.show_by_year', compact('months', 'batchs', 'years', 'year_selected','budget'));
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
            ->orderBy('batchs.name','asc')
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


        // dd($details);

        return view('budgets.show_by_year_month', compact('months', 'month_selected', 'years', 'year_selected', 'batchs', 'details','budget'));
    }

    public function edit_detail_budget($id)
    {
        
        $details_budgets = DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
            ->join('months', 'months.id', '=', "details_budgets.month_id")
            ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
            ->where('details_budgets.id', '=', $id)
            ->select('details_budgets.*', 'months.name as name_month', 'batchs.name as name_batch')
            ->first();
            
        return view('budgets.edit_details', compact('details_budgets'));
    }

    /* Others Functions*/
    protected function save_details_budget(
        $id_budget,
        $price_dollars,
        $month_id,
        $quantity,
        $description,
        $batch_id,
        $unit_price,
        $total_soles,
        $total_dollars
    ) {

        for ($i = 0; $i < count($month_id); $i++) {
            $data  = array(
                'budget_id' => $id_budget,
                'price_dollar' => $price_dollars,
                'quantity' => $quantity[$i],
                'description' => $description[$i],
                'unit_price' => $unit_price[$i],
                'total_soles' => $total_soles[$i],
                'total_dollars' => $total_dollars[$i],
                'month_id' => $month_id[$i],
                'batch_id' => $batch_id[$i],
            );


            $detail = new DetailsBudgetModel($data);

            $detail->save();
        }
    }
}
