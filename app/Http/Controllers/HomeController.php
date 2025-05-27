<?php

namespace App\Http\Controllers;
use App\Events\UserSubscribed;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index() {
        $usertype = '';
        $orders = 0;
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->where('status', '!=', 'Delivered')->count();
        } else {
            $count = 0;
        }
        $product = Product::latest()->limit(3)->get();
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        return view('home.index', compact(['product', 'usertype', 'categories', 'count', 'orders']));
    }

    public function login() {
        return view('home.login');
    }

    public function signup() {
        return view('home.signup');
    }

    public function register(Request $request) {
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);

        $user = User::create($fields);

        Auth::login($user);

        event(new Registered($user));

        if ($request->subscribe) {
            event(new UserSubscribed($user));
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function loginPost(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($fields, $request->remember)) {
            return redirect('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records'
            ]);
        }
    }

    public function showProducts() {
        $usertype = '';
        $orders = 0;
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        }
        else {
            $count = 0;
        }
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        $product = Product::latest()->paginate(9);
        return view('home.products', compact(['product', 'usertype', 'categories', 'count', 'orders']));
    }

    public function searchByCategory($category) {
        $usertype = '';
        $count = 0;
        $orders = 0;
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        }
        $search = $category;
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        $product = Product::where('category_name', $search)->paginate(9);
        $countSearch = $product->count();
        return view('home.searchProduct', compact(['product', 'count', 'search', 'usertype', 'categories', 'countSearch', 'orders']));
    }

    public function search(Request $request) {
        $usertype = '';
        $count = 0;
        $orders = 0;
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        }
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category_name', 'LIKE', '%' . $search . '%')->paginate(9);
        $countSearch = $product->count();
        return view('home.searchProduct', compact(['product', 'count', 'search', 'usertype', 'categories', 'countSearch', 'orders']));
    }

    public function productDetails($id) {
        $usertype = '';
        $orders = 0;
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        } else {
            $count = 0;
        }
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        $product = Product::find($id);
        return view('home.productDetails', compact(['product', 'usertype', 'categories', 'count', 'orders']));
    }

    public function addCart($id) {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        sweetalert()->success('Added to cart successfully.');
        return redirect()->back();
    }

    public function cart() {
        $usertype = '';
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        }
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        return view('home.cart', compact(['usertype', 'categories', 'cart', 'count', 'orders']));
    }

    public function deleteCart($id) {
        $product = Cart::find($id);
        $product->delete();
        sweetalert()->success('Removed from cart successfully.');
        return redirect()->back();
    }

    public function confirmOrder(Request $request) {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();
        foreach($cart as $carts) {
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->status = 'In Progress';
            $order->save();
        }
        sweetalert()->success('Product ordered successfully.');
        $cart_remove = Cart::where('user_id', $userid)->get();
        foreach($cart_remove as $remove) {
            $data = Cart::find($remove->id);
            $data->delete();
        }
        return redirect()->back();
    }

    public function order() {
        $usertype = '';
        if(Auth::id()) {
            $user = Auth::user();
            $usertype = $user->usertype;
            $userid = $user->id;
            $delivered = 'Delivered';
            $count = Cart::where('user_id', $userid)->count();
            $data = Order::where('user_id', $userid)->get();
            $orders = Order::where('user_id', $userid)->where('status', '!=', 'Delivered')->count();
        }
        $category = Category::all();
        $categories = [];
        foreach($category as $category) {
            $categories[] = $category->category_name;
        }
        return view('home.order', compact(['usertype', 'categories', 'count', 'data', 'orders']));
    }
}
