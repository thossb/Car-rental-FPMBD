<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.homepage');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function search()
    {
        return view('frontend.search_car');
    }

    public function list_car()
    {
        return view('frontend.list_car');
    }

    public function detail_car()
    {
        return view('frontend.detail_car');
    }

    public function manage_booking()
    {
        return view('frontend.manage_booking');
    }

    public function payment_details()
    {
        return view('frontend.payment_details');
    }

    public function payment_receipt()
    {
        return view('frontend.payment_receipt');
    }

    public function detail()
    {
        return view('frontend.detail');
    }
}
