<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // si usas usuarios
use App\Models\Product; // si manejas productos
use App\Models\Order; // si manejas órdenes

class AdminController extends Controller
{
    // CRUD de productos
    public function products(Request $request) {
    $search = $request->get('search');

    $products = Product::query()
        ->when($search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('id', $search);
        })
        ->get();

    return view('admin.products.index', compact('products'));
}


    public function productsCreate() {
        return view('admin.products.create');
    }

     public function productsStore(Request $request) {
        Product::create($request->only('name','description','price','image','stock'));
        return redirect()->route('admin.products.index')->with('success', 'Producto agregado.');
    }

    public function productsEdit($id) {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function productsUpdate(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->only('name','description','price','image','stock'));
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado.');
    }

    public function productsDestroy($id) {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado.');
    }

    // Órdenes
    public function orders() {
        $orders = Order::with('items')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersUpdateStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->status; // 'pendiente', 'completada', 'cancelada'
        $order->save();
        return redirect()->back()->with('success', 'Estado actualizado.');
    }
	public function users() {
    $users = \App\Models\User::all();
    return view('admin.users', compact('users'));
}
public function makeAdmin($id)
{
    $user = \App\Models\User::findOrFail($id);
    $user->is_admin = true;
    $user->save();

    return redirect()->back()->with('success', 'Usuario ahora es administrador.');
}

}
