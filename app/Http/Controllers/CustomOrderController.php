<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomOrder;

class CustomOrderController extends Controller
{
    public function create()
    {
        return view('custom_orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'country'     => 'required|string|max:255',
            'image_url'   => 'nullable|url',
            'email'       => 'required|email',
        ]);

        CustomOrder::create($request->all());

        return redirect()->route('custom-order.form')->with('success', 'Tu encargo ha sido enviado correctamente.');
    }

    public function index()
    {
        $orders = CustomOrder::latest()->get();
        return view('admin.custom_orders.index', compact('orders'));
    }
}
