<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branch::all();
        return view('admin.branch.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getDetail(Request $request){
        $branch = Branch::findOrFail($request->id);

        return response()->json([
            'status' => 'success',
            'branch' => $branch,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Branch();
        $data->location = $request->location;
        $data->save();
        return back()->with('success', 'Data Branch successfully added !');
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
        $data = Branch::findOrFail($request->id_branch);
        $data->location = $request->location;
        $data->save();
        return back()->with('success', 'Data Branch successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        if($branch){
            
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
