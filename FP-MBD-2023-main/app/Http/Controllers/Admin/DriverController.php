<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Driver::all();
        return view('admin.driver.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getDetail(Request $request){
        $driver = Driver::findOrFail($request->id);

        return response()->json([
            'status' => 'success',
            'driver' => $driver,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Driver();
        $data->name = $request->name;
        $data->age = $request->age;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->commission = $request->commission;
        $data->save();
        return back()->with('success', 'Data Driver successfully added !');
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
        $data = Driver::findOrFail($request->id_driver);
        $data->name = $request->name;
        $data->age = $request->age;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->commission = $request->commission;
        $data->save();
        return back()->with('success', 'Data Driver successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        if($driver){
            
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
