<?php

namespace App\Http\Controllers\Budgets;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\BatchsModel;
use App\Models\Maintenance\MonthsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $months = MonthsModel::all();
        $batchs = BatchsModel::join('areas','areas.id','=','batchs.area_id')
        ->where('areas.representative_id','=',$id)
        ->where('batchs.status','=','available')
            ->select('batchs.*')
            ->get()->toArray();

        return view('budgets.index', compact('months','batchs'));
    }

    public function create()
    {
//        $roles = RolesModel::where('status','=','available')->get();
//        return view('maintenance.users.create',compact('roles'));

        echo "create";
    }

    public function store(Request $request)
    {


        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ]);
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role_id' => $request->get('role_id')
        ]);
        $user->save();
        return redirect('users')->with('success', 'Usuario Guardado!');

    }

    public function show(Batchs $batchs)
    {
        //
    }

    public function edit($id)
    {
        $roles = RolesModel::where('status','=','available')->get();
        $user = User::find($id);
        return view('maintenance.users.edit', compact('roles','user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
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

    public function enable($id)
    {
        $user = User::find($id);
        $user->status = 'available';
        $user->save();
        return redirect('/users')->with('success', 'Usuario Activado!');
    }

}
