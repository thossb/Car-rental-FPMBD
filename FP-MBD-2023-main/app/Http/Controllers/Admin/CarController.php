<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Branch;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = Branch::all();
        $data = Vehicle::all();
        return view('admin.car.index',compact('data','branch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getDetail(Request $request){
        $vehicle = Vehicle::findOrFail($request->id);

        return response()->json([
            'status' => 'success',
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Vehicle();
        $data->plate_number = $request->plate_number;
        $data->name = $request->name;
        $data->type = $request->type;
        $data->capacities = $request->capacities;
        $data->branch_id = $request->branch_id;        
        $data->rent_price = $request->rent_price;
        $data->driver_price = $request->driver_price;
        $data->registration = $request->registration;
        if($request->file('image')){
            $file = $request->file('image');
            $nama_file = time()."_".$file->getClientOriginalName();
            $path = 'vehicle/image';
            $file->move($path,$nama_file);
            $data->image = $nama_file;
        }
        $data->save();
        return back()->with('success', 'Data Vehicle successfully added !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Vehicle::findOrFail($request->id_vehicle);
        $data->plate_number = $request->plate_number;
        $data->name = $request->name;
        $data->type = $request->type;
        $data->capacities = $request->capacities;
        $data->branch_id = $request->branch_id;        
        $data->rent_price = $request->rent_price;
        $data->driver_price = $request->driver_price;
        $data->registration = $request->registration;
        if($request->file('image')){
            $file = $request->file('image');
            $nama_file = time()."_".$file->getClientOriginalName();
            $path = 'vehicle/image';
            $file->move($path,$nama_file);
            $data->image = $nama_file;
        }
        $data->save();
        return back()->with('success', 'Data Vehicle successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $file_path = public_path('vehicle/image') . $vehicle->image;
        if(file_exists($file_path)){
            unlink($file_path);
        }
        $vehicle->delete();

        if($vehicle){
            
            return redirect()->back()->with([
                'success' => 'Data successfully deleted !',
            ]);
        }else{
            return redirect()->back()->withInput()->with([
                'error' => 'Data cant deleted !',
            ]);
        }
    }
}
