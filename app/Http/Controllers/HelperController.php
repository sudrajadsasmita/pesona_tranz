<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelperRequest;
use App\Models\Helper;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Helper::all();
        if (request()->ajax()) {
            return DataTables::of($items)
                ->addColumn('Actions', '<a href="javascript:void(0)" id="btnUpdate" class="btn btn-warning btn-sm" data-id="{{ $id }}"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete" data-id="{{ $id }}"><i class="fa fa-trash"></i></a>')
                ->rawColumns(['Actions'])->addIndexColumn()->make(true);
        }

        return view('pages.helper.index');
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
    public function store(HelperRequest $request)
    {
        $item = $request->all();
        if ($request->hasFile('photo')) {
            $item['photo'] = $request->file('photo')->store(
                'assets/helper',
                'public'
            );
        }
        $data = Helper::create($item);

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
        $data = Helper::findOrFail($id);

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $data = Helper::findOrFail($id);

        $vehicle = Vehicle::where('helper_id', $data['id']);
        if ($vehicle) {
            $vehicle->update(['helper_id' => null]);
        }

        $data->delete();

        return response()->json($data, 200);
    }

    public function submitUpdate(HelperRequest $request, $id)
    {
        $item = $request->all();
        if ($request->hasFile('photo')) {
            $item['photo'] = $request->file('photo')->store(
                'assets/helper',
                'public'
            );
        }
        $data = Helper::findOrFail($id);
        $data->update($item);

        return response()->json($data, 200);
    }
}
