<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
	
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }
	
    public function show()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('cart.show', compact('cart', 'total'));
    }
	public function addAjax(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);

    $cart[$id] = $cart[$id] ?? [
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => 0,
        'image' => $product->image,
    ];
    $cart[$id]['quantity']++;

    session()->put('cart', $cart);

    // Retornamos JSON con totalItems para actualizar la bolita roja
    return response()->json([
        'success' => true,
        'totalItems' => count($cart)
    ]);
}


    public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);

    // Si no hay stock disponible
    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Este producto está agotado.');
    }

    // Si el producto ya está en el carrito
    if (isset($cart[$id])) {
        // Verifica que no se sobrepase el stock
        if ($cart[$id]['quantity'] < $product->stock) {
            $cart[$id]['quantity']++;
        } else {
            return redirect()->back()->with('error', 'No hay más stock disponible.');
        }
    } else {
        // Nuevo producto
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image,
            'stock' => $product->stock, // solo informativo, no afecta la lógica
        ];
    }

    session()->put('cart', $cart);

    // 👇 Si estás usando AJAX para actualizar el contador dinámico
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'totalItems' => count($cart)
        ]);
    }

    return redirect()->back()->with('success', 'Producto agregado al carrito.');
}



public function checkout(Request $request) {
    $cart = session('cart', []);
    if(empty($cart)){
        return redirect('/')->with('error', 'El carrito está vacío.');
    }

    $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    $order = Order::create([
        'user_id' => auth()->id(), // revisa que tu tabla orders tenga esta columna
        'total' => $total,
        'status' => 'pendiente',
    ]);

    foreach($cart as $id => $item){
        $order->items()->create([
            'product_id' => $id,
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);

        // Actualiza stock
        $product = Product::find($id);
        $product->stock -= $item['quantity'];
        $product->save();
    }

    session()->put('order_id', $order->id);
    session()->forget('cart');

    return redirect()->route('cart.confirmation');
}




  

    public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);
    $product = \App\Models\Product::find($id);

    if (!$product || !isset($cart[$id])) {
        return response()->json(['success' => false, 'message' => 'Producto no encontrado.']);
    }

    $newQuantity = (int) $request->quantity;

    // ⚠️ Verificar que no exceda el stock
    if ($newQuantity > $product->stock) {
        $newQuantity = $product->stock;
    }

    // ⚠️ Evitar valores menores que 1
    $cart[$id]['quantity'] = max(1, $newQuantity);

    session()->put('cart', $cart);

    // 🔹 Recalcular totales
    $subtotal = $cart[$id]['price'] * $cart[$id]['quantity'];
    $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    return response()->json([
        'success' => true,
        'subtotal' => number_format($subtotal, 2),
        'total' => number_format($total, 2),
        'quantity' => $cart[$id]['quantity'],
    ]);
}



public function remove(Request $request, $id){
    $cart = session('cart', []);
    unset($cart[$id]);
    session(['cart'=>$cart]);

    if($request->ajax()){
        $total = number_format(array_sum(array_map(fn($i)=>$i['price']*$i['quantity'], $cart)),2);
        $totalItems = array_sum(array_map(fn($i)=>$i['quantity'], $cart));
        return response()->json(['success'=>true,'total'=>$total,'totalItems'=>$totalItems]);
    }

    return redirect()->back();
}





    // Página de confirmación
   public function confirmation(Request $request){
    $orderId = session('order_id');
    if(!$orderId){
        return redirect('/'); // si no hay orden, vuelve al inicio
    }

    $order = \App\Models\Order::with('items')->find($orderId);
    if(!$order){
        return redirect('/')->with('error', 'Orden no encontrada.');
    }

    // Opcional: borrar order_id de sesión para que no se repita
    session()->forget('order_id');

    return view('cart.confirmation', compact('order'));
}


}
