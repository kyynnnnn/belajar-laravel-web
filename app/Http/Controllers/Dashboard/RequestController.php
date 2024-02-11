<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderStatus;

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
        $orders = Order::where('buyer_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.dashboard.request.index', compact('orders'));
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
        $order = Order::where('id', $id)->first();

        return view('pages.dashboard.request.detail', compact('order'));
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


    // custom function
    public function approve($id)
    {
        $order = Order::where('id', $id)->first();

        // update order status
        $order = Order::find($order['id']);
        $order->order_status_id = 1;
        $order->save();

        // alert success
        toast()->success('Approve has been success');

        // lempar ke page request index
        return redirect()->route('member.request.index');
    }
}
