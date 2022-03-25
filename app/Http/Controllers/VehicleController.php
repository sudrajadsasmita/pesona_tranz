<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Driver;
use App\Models\Helper;
use App\Models\Vehicle;
use App\Models\VehicleGallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Vehicle::with(["driver", "helper"])->get();
        // dd($items);
        if (request()->ajax()) {
            return DataTables::of($items)
                ->addColumn('Actions', '<a href="vehicle/{{$id}}/gallery" class="btn btn-info btn-sm"><i class="fas fa-image"></i></a>
                    <a href="javascript:void(0)" id="btnUpdate" class="btn btn-warning btn-sm" data-id="{{ $id }}"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete" data-id="{{ $id }}"><i class="fa fa-trash"></i></a>')
                ->rawColumns(['Actions'])->addIndexColumn()->make(true);
        }
        $drivers = Driver::all();
        $helpers = Helper::all();
        return view('pages.vehicles.index')->with([
            'drivers' => $drivers,
            'helpers' => $helpers
        ]);
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
    public function store(VehicleStoreRequest $request)
    {
        $item = $request->all();
        $data = Vehicle::create($item);

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
        $item = Vehicle::findOrFail($id);

        return response()->json($item, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleUpdateRequest $request, $id)
    {
        $item = $request->all();
        $data = Vehicle::findOrFail($id);
        $data->update($item);

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vehicle::findOrFail($id);

        VehicleGallery::where('vehicle_id', $id)->delete();

        $data->delete();

        return response()->json($data, 200);
    }

    public function gallery($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $items = VehicleGallery::with("vehicle")->where("vehicle_id", $id)->get();
        // dd($items);
        if (request()->ajax()) {
            return DataTables::of($items)
                ->addColumn('Actions', '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete" data-id="{{ $id }}"><i class="fa fa-trash"></i></a>')
                ->rawColumns(['Actions'])->addIndexColumn()->make(true);
        }

        return view('pages.gellery.index')->with([
            'vehicle' => $vehicle
        ]);
    }
}
