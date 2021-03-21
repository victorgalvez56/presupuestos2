<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\AreasModel;
use App\Models\Maintenance\BatchsModel;

use Illuminate\Http\Request;

class BatchsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('AdministradorSistema');

        $batchs = BatchsModel:: join('areas', 'areas.id', '=', 'batchs.area_id')
            ->orderby('batchs.status', 'desc')
            ->select('batchs.*', 'areas.name as name_area')
            ->get();
        return view('maintenance.batchs.index', compact('batchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('AdministradorSistema');

        $areas = AreasModel::where('status','=','available')->orderBy('name','asc')->get();
        return view('maintenance.batchs.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('AdministradorSistema');

        $request->validate([
            'name'=>'required',
            'area_id'=>'required',
        ]);
        $batchs = new BatchsModel([
            'name' => $request->get('name'),
            'area_id' => $request->get('area_id'),
        ]);
        $batchs->save();
        return redirect('batchs')->with('success', 'Partida Guardada!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batchs  $batchs
     * @return \Illuminate\Http\Response
     */
    public function show(Batchs $batchs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batchs  $batchs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('AdministradorSistema');

        $areas = AreasModel::where('status','=','available')->orderBy('name','asc')->get();
        $batch = BatchsModel::find($id);
        return view('maintenance.batchs.edit', compact('batch','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batchs  $batchs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('AdministradorSistema');

        $request->validate([
            'name'=>'required',
            'area_id'=>'required',
        ]);

        $batch = BatchsModel::find($id);
        $batch->name =  $request->get('name');
        $batch->area_id = $request->get('area_id');
        $batch->save();
        return redirect('/batchs    ')->with('success', 'Partida Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batchs  $batchs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('AdministradorSistema');

        $batch = BatchsModel::find($id);
        $batch->status = 'unavailable';
        $batch->save();
        return redirect('/batchs')->with('success', 'Partida Desactivada!');
    }
    public function enable($id)
    {
        $this->authorize('AdministradorSistema');

        $batch = BatchsModel::find($id);
        $batch->status = 'available';
        $batch->save();
        return redirect('/batchs')->with('success', 'Partida Activada!');
    }

}
