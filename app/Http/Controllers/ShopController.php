<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // return $products;
        return view('user.home', compact('products'));
    }
    //Show all Products
    public function products()
    {
        $categories = Category::all();
        $products = Product::paginate(6);

        return view('user.products', compact('categories', 'products'));
    }
    //Show a single product
    public function singleProduct($id)
    {
        $product = Product::find($id);
        return view('user.single-product', compact('product'));
    }
    //show CART
    public function cart()
    {
        return view('user.cart');
    }
    // Add product to CART
    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->price,
                    'photo' => $product->image
                ]
            ];
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'photo' => $product->image
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
    //Update  CART
    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            session()->flash('success', 'Cart Updated Successfully');
        }
    }
    //Remove Item from CART
    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return $request;
    }
    //Checkout
    public function checkout()
    {

        return view('user.checkout');
    }
    //Order product
    public function order(Request $request)
    {
        $request->validate([
            "fname" => 'required',
            "lname" => 'required',
            "country" => 'required',
            "street" => 'required',
            "city" => 'required',
            "postcode" => 'required',
            "phone" => 'required',
            "email" => 'required'
        ]);
        $address = new Address;
        $address->fname = $request->fname;
        $address->lname = $request->lname;
        $address->country = $request->country;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->postcode = $request->postcode;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->save();

        $order = new Order;
        $order->address_id = $address->id;
        $order->save();

        if (session()->get('cart')) {
            $cart = session()->get('cart');
            foreach (session()->get('cart') as $id => $details) {
                $order_product = new OrderProduct;
                $order_product->order_id = $order->id;
                $order_product->product_id = $id;
                $order_product->quantity = $details['quantity'];
                $order_product->total_price = $details['price'] * $details['quantity'];
                $order_product->save();
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect("/products")->with('success', 'Order confirmed successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
