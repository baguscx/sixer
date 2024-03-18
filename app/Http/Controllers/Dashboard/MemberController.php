<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('freelancer_id', Auth::user()->id)->get();
        $progress = Order::where('freelancer_id', Auth::user()->id)
                        ->where('order_status_id', 2)
                        ->count();
        $completed = Order::where('freelancer_id', Auth::user()->id)
                        ->where('order_status_id', 1)
                        ->count();
        $freelancer = Order::where('buyer_id', Auth::user()->id)
                        ->where('order_status_id', 2)
                        ->disctrict('freelancer_id')
                        ->count();
        return view('sixer.pages.dashboard.index', compact('orders', 'progress', 'completed', 'freelancer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }
}
