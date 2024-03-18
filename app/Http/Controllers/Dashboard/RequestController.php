<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
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
        $orders = Order::where('buyer_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('sixer.pages.dashboard.request.index', compact('orders'));
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
        //detail
        $order = Order::where('id', $id)->first();
        return view('sixer.pages.dashboard.request.detail', compact('order'));
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

    //custom function
    public function approve($id){
        $order = Order::where('id', $id)->first();

        //update order
        $order = Order::find($order['id']);
        $order->order_status_id = 1;
        $order->save();

        toast()->success('Approve has been success');
        return redirect()->route('member.request.index');
    }
}
