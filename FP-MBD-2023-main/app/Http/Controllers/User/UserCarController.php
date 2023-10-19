<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Branch;
use App\Models\Booking;
use App\Models\User;
use App\Models\Feedback_type;
use App\Models\UserFeedback;
use App\Models\Rental;
use App\Models\Payments;
use Carbon\Carbon;
use DB;
use DateTime;
use Session;
use Redirect;
use Auth;

class UserCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Vehicle::all();
        return view('admin.car.index',compact('data'));
    }

    public function list_car(){
        $data = Vehicle::all();
        return view('frontend.list_car',compact('data'));
    }

    public function dashboard_user(){
        return view('frontend.dashboard_user');
    }

    public function booking_history(){
        $data = DB::select('

            SELECT b.*, v.name AS vehicle_name,v.branch_id, br.location, u.name AS client_name, u.email, u.address, u.phone_number,
            u.identity_number, r.start_time, r.end_time,r.delivery_add, r.pickup_address, p.payment_date_time, p.payment_method
            FROM bookings as b
            LEFT JOIN vehicle as v ON b.vehicle_id = v.id
            LEFT JOIN branch as br ON br.id = v.branch_id
            LEFT JOIN users as u ON b.client_id = u.id
            LEFT JOIN rental as r ON b.rental_id = r.id
            LEFT JOIN payments as p ON b.payment_id  = p.id
            GROUP BY b.id

        ');
        return view('frontend.booking_history',compact('data'));
    }

    public function detail_car($id){
        $data = Vehicle::findOrFail($id);
        $data_review = DB::select('

            SELECT user_feedback.*, bookings.vehicle_id, bookings.feedback_id, bookings.client_id, users.name
            FROM user_feedback
            LEFT JOIN bookings ON user_feedback.id = bookings.feedback_id
            LEFT JOIN users ON bookings.client_id = users.id
            WHERE bookings.vehicle_id = '.$id.'
            GROUP BY user_feedback.id
            LIMIT 2
        ');
        return view('frontend.detail_car',compact('data','data_review'));
    }

    public function feedback(Request $request){
        
        $data = new UserFeedback();
        $data->type_id = $request->type_id;
        $data->description = $request->description;
        $data->save();
        $data_booking = Booking::findOrFail($request->id);
        $data_booking->feedback_id = $data->id;
        $data_booking->save();
        return back()->with('success', 'Feedback successfully added !');
    }
    
    public function payment_receipt($id){
        $data = DB::select('

            SELECT b.*, v.name,v.branch_id, br.location, u.name, u.email, u.address, u.phone_number,
            u.identity_number, r.start_time, r.end_time,r.delivery_add, r.pickup_address, p.payment_date_time, p.payment_method
            FROM bookings as b
            LEFT JOIN vehicle as v ON b.vehicle_id = v.id
            LEFT JOIN branch as br ON br.id = v.branch_id
            LEFT JOIN users as u ON b.client_id = u.id
            LEFT JOIN rental as r ON b.rental_id = r.id
            LEFT JOIN payments as p ON b.payment_id  = p.id
            WHERE b.id = '. $id .'
            GROUP BY b.id

        ')[0];
        $type = Feedback_type::all();
        $vehicle = Vehicle::findOrFail($data->vehicle_id);
        $user = User::findOrFail($data->client_id);
        return view('frontend.payment_receipt',compact('data','vehicle','user','type'));
    }

    public function book($id){
        $data = Vehicle::findOrFail($id);
        session()->put('id_car', $id);
        return view('frontend.manage_booking',compact('data'));
    }

    public function payment_details(Request $request){
        $data = Vehicle::findOrFail(session('id_car'));
        session()->put('pickup_location', $request->pickup_location);
        session()->put('dropoff_location', $request->dropoff_location);
        return view('frontend.payment_details',compact('data'));
    }
    

    public function register()
    {
        return view('frontend.register');
    }

    public function action_register(Request $request)
    {

        $data = new User();
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->name = $request->full_name;
        $data->identity_number = $request->identity_number;
        $data->gender = $request->gender;
        $data->address = $request->address;
        $data->phone_number = $request->phone_number;
        $data->save();

        return back()->with('success', 'Your account Successfully added, please login !');
    }


    public function booking_finish(Request $request)
    {   

        $vehicle = Vehicle::findOrFail($request->id_car);
        $date = (new Carbon($request->pickup_date))->addDays($request->duration);
        $date = $date->format('Y-m-d');

        $rental = new Rental();
        $rental->start_time = $request->pickup_date;
        $rental->end_time = $date;
        $rental->pickup_address = session('pickup_location');
        $rental->save();

        $payments = new Payments();
        $payments->payment_method = $request->payments_method;
        $payments->save();

        $data = new Booking();
        $data->client_id = auth()->guard('user')->id();
        $data->vehicle_id = $vehicle->id;
        $data->booking_date = $request->pickup_date;
        $data->rental_id = $rental->id;
        $data->payment_id = $payments->id;
        // $data->booking_closed = $date;
        $data->booking_closed = 1;
        if(session('with_driver')){
            $data->booking_amount = ($vehicle->driver_price+$vehicle->rent_price) * $request->duration ;
        }else{
            $data->booking_amount = $request->duration*$vehicle->rent_price;
        }

        $data->save();
        $user = User::findOrFail(auth()->guard('user')->id());
        return Redirect::route('payment_receipt',$data->id);
    }

    public function search_car()
    {
        $data_branch = Branch::all();
        return view('frontend.search_car',compact('data_branch'));
    }


    public function searching_car(Request $request){
        $newPickup = date("D, d M Y", strtotime($request->pickup_date));
        if($request->with_driver){

            $date = (new Carbon($request->pickup_date))->addDays($request->duration);
            $date = $date->format('Y-m-d');
            $newDrop = date("D, d M Y", strtotime($date));

            session()->put('new_dropoff', $newDrop);
            session()->put('with_driver', true);
            session()->put('branch', $request->branch);
            session()->put('new_pickup', $newPickup);
            session()->put('pickup_date', $request->pickup_date);
            session()->put('duration', $request->duration);
            session()->put('pickup_time', $request->pickup_time);
        }else{
            $drop_off = $request->drop_off;
            $pickup_date = $request->pickup_date;
            $datetime1 = new DateTime($pickup_date);
            $datetime2 = new DateTime($drop_off);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//now do whatever you like with $days
            $duration = $days;
            $date = (new Carbon($request->pickup_date))->addDays($days);
            $date = $date->format('Y-m-d');
            $newDrop = date("D, d M Y", strtotime($date));
            session()->put('new_pickup', $newPickup);
            session()->put('new_dropoff', $newDrop);
            session()->put('branch', $request->branch);
            session()->put('pickup_date', $request->pickup_date);
            session()->put('duration', $days);
            session()->put('drop_off', $request->drop_off);
        }

        $id = $request->branch;
        $data = Vehicle::where('branch_id',$id)->get();
        return view('frontend.list_car',compact('data'));
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
