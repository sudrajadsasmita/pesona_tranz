<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Driver::all();
        if (request()->ajax()) {
            return DataTables::of($items)
                ->addColumn('Actions', '<a href="javascript:void(0)" id="btnUpdate" class="btn btn-warning btn-sm" data-id="{{ $id }}"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete" data-id="{{ $id }}"><i class="fa fa-trash"></i></a>')
                ->rawColumns(['Actions'])->addIndexColumn()->make(true);
        }

        return view('pages.driver.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        $item = $request->all();
        if ($request->hasFile('photo')) {
            $item['photo'] = $request->file('photo')->store(
                'assets/driver',
                'public'
            );
        }
        $data = Driver::create($item);

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Driver::findOrFail($id);

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Driver::findOrFail($id);

        $vehicle = Vehicle::where('driver_id', $data['id']);
        if ($vehicle) {
            $vehicle->update(['driver_id' => null]);
        }

        $data->delete();

        return response()->json($data, 200);
    }

    public function submitUpdate(DriverRequest $request, $id)
    {
        $item = $request->all();
        if ($request->hasFile('photo')) {
            $item['photo'] = $request->file('photo')->store(
                'assets/driver',
                'public'
            );
        }
        $data = Driver::findOrFail($id);
        $data->update($item);

        return response()->json($data, 200);
    }
}
