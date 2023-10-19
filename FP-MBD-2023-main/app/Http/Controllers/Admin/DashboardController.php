<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $total_bookings = DB::select('
        SELECT b.location, COUNT(*) AS total_bookings FROM bookings 
        bk LEFT JOIN vehicle v ON bk.vehicle_id = v.id LEFT JOIN branch 
        b ON v.branch_id = b.id GROUP BY b.location;
    ');


    
    $total_earnings = DB::select("
        SELECT SUM(b.booking_amount) AS total_amount
        FROM bookings as b
        WHERE MONTH(b.booking_date) = Month(CURRENT_DATE())
    ")[0];

    $annual_earnings = DB::select("
        SELECT SUM(b.booking_amount) AS total_amount
        FROM bookings as b
        WHERE YEAR(b.booking_date) = YEAR(CURRENT_DATE())
    ")[0];

        return view('admin.dashboard',compact('total_bookings','total_earnings','annual_earnings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
