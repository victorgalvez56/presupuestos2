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
        return view('budgets.index', compact('months', 'years','batchs'));
    }

    public function create()
    {
        echo "create";
    }

    public function store(Request $request)
    {
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

        $budget = new BudgetsModel([
            'price_dollar' => $price_dollar,
            'total_budget_soles' => $total_budget_soles,
            'total_budget_dollar' => $total_budget_dollar,
            'representative_id' => Auth::id()
        ]);

        $budget->save();

        $this->save_details_budget($budget['id'], $month_id, $quantity, $description, $batch_id, $unit_price, $total_soles, $total_dollars);


        if ($budget->save()) {
            return redirect('budgets')->with('success', 'Prespuesto Guardado!');
        } else {
            return redirect('budgets')->with('success', 'Prespuesto No Guardado!');
        }
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
 
        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->select('batchs.*')
            ->get()->toArray();
        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();



        return view('budgets.show_by_year', compact('months', 'batchs', 'years','year_selected'));
    }

    public function show_by_year_month($year_selected, $month)
    {


        $id = Auth::user()->id;
        $id_month = MonthsModel::where('name','=',$month)->first();
        $months = MonthsModel::all();
        $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
            ->where('areas.representative_id', '=', $id)
            ->where('batchs.status', '=', 'available')
            ->select('batchs.*')
            ->get()->toArray();
        $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')->orderBy('year', 'desc')->get();


        $details_budgets = DetailsBudgetModel::join('budgets','budgets.id','=','details_budgets.budget_id')
        ->join('months','months.id','=',"details_budgets.month_id")
        ->join('batchs','batchs.id','=',"details_budgets.batch_id")
        ->where('budgets.representative_id','=',$id)
        ->where('details_budgets.month_id','=',$id_month->id)
        ->whereYear('details_budgets.created_at','=',$year_selected)
        ->select('details_budgets.*','months.name as name_month','batchs.name as name_batch')
        ->get();

/*map reduce para agrupar por batchs*/

        dd($details_budgets);
        // $id = Auth::user()->id;
        // $year_selected = $request->year;
        // $months = MonthsModel::all();
        // $budgets = BudgetsModel::whereYear('created_at', '=', $request->year)
        //     ->get();
        // $batchs = BatchsModel::join('areas', 'areas.id', '=', 'batchs.area_id')
        //     ->where('areas.representative_id', '=', $id)
        //     ->where('batchs.status', '=', 'available')
        //     ->select('batchs.*')
        //     ->get()->toArray();
        // $years = BudgetsModel::selectRaw('YEAR(created_at) as year')
        //     ->groupBy('year')->orderBy('year', 'desc')->get();



        // return view('budgets.show_by_year', compact('months', 'batchs', 'years','year_selected'));
    }
    
    /* Others Functions*/
    protected function save_details_budget(
        $id_budget,
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
