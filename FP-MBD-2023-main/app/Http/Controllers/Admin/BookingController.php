<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\UserFeedback;
use DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::SELECT('

            SELECT * FROM bookings_detail

        ');
        return view('admin.booking.index',compact('data'));
    }

    public function feedback()
    {
        $data = DB::select('

                SELECT user_feedback.*, bookings.vehicle_id,vehicle.name AS vehicle_name, bookings.feedback_id,
                bookings.client_id, users.name AS client_name,bookings.booking_date, bookings.booking_amount
                FROM user_feedback
                LEFT JOIN bookings ON user_feedback.id = bookings.feedback_id
                LEFT JOIN users ON bookings.client_id = users.id
                LEFT JOIN vehicle ON bookings.vehicle_id = vehicle.id
                GROUP BY user_feedback.id

        ');

        $data_count = DB::select('
            SELECT ft.categories, COUNT(*) AS feedback_count
            FROM feedback_type ft
            JOIN user_feedback uf ON ft.id = uf.type_id
            GROUP BY ft.categories
            ORDER BY COUNT(*) DESC;        
        ');

        return view('admin.feedback.index',compact('data','data_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getDetail(Request $request){
        $booking = DB::select('

            SELECT b.*, v.name,v.branch_id, br.location, u.name, u.email, u.address, u.phone_number,
            u.identity_number, r.start_time, r.end_time,r.delivery_add, r.pickup_address, p.payment_date_time, p.payment_method
            FROM bookings as b
            LEFT JOIN vehicle as v ON b.vehicle_id = v.id
            LEFT JOIN branch as br ON br.id = v.branch_id
            LEFT JOIN users as u ON b.client_id = u.id
            LEFT JOIN rental as r ON b.rental_id = r.id
            LEFT JOIN payments as p ON b.payment_id  = p.id
            WHERE b.id = '. $request->id .'
            GROUP BY b.id

        ')[0];

        return response()->json([
            'status' => 'success',
            'booking' => $booking,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
        
    }

    public function addFine(Request $request)
    {
        $data = Booking::findOrFail($request->id_booking);
        $data->fine = $request->fine;
        $data->save();
        return back()->with('success', 'Data Fine successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
