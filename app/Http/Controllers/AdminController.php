<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard() {
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }

    public function addProduct() {
        $user = Auth::user();
        $category = Category::all();
        return view('admin.addProduct', compact('category', 'user'));
    }

    public function viewCategory() {
        $user = Auth::user();
        $data = Category::all();
        return view('admin.category', compact('data', 'user'));
    }

    public function addCategory(Request $request)
    {
        $category = new Category;
        if($request->category) {
            $category->category_name = $request->category;
            $category->save();
            sweetalert()->success('Category is added successfully.');
        }
        return redirect()->back();
    }

    public function deleteCategory($id) {
        $data = Category::find($id);
        $data->delete();
        sweetalert()->success('Category is deleted successfully.');
        return redirect()->back();
    }

    public function editCategory($id) {
        $user = Auth::user();
        $data = Category::find($id);
        return view('admin.editCategory', compact('data', 'user'));
    }

    public function updateCategory(Request $request, $id) {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        sweetalert()->success('Category is updated successfully.');
        return redirect('viewCategory');
    }

    public function uploadProduct(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category_name = $request->category;
        $image = $request->image;
        if($image)
        {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        sweetalert()->success('Product is added successfully.');
        return redirect()->back();
    }

    public function viewProduct() {
        $user = Auth::user();
        $product = Product::paginate(10);
        return view('admin.viewProduct', compact('product', 'user'));
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        if($product->image) {
            $image_path = public_path('products/' . $product->image);
            if(file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $product->delete();
        sweetalert()->success('Product is deleted successfully.');
        return redirect()->back();
    }

    public function editProduct($id) {
        $user = Auth::user();
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.editProduct', compact(['product', 'category', 'user']));
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_name = $request->category;
        $product->quantity = $request->quantity;
        if($request->image) {
            if($product->image) {
                $image_path = public_path('products/' . $product->image);
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        sweetalert()->success('Product is updated successfully.');
        return redirect('/viewProduct');
    }

    public function searchProduct(Request $request) {
        $user = Auth::user();
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category_name', 'LIKE', '%' . $search . '%')->paginate(10);
        $count = $product->count();
        return view('admin.searchProduct', compact(['product', 'search', 'count', 'user']));
    }

    public function orders() {
        $user = Auth::user();
        $data = Order::all();
        return view('admin.orders', compact('data', 'user'));
    }

    public function onTheWay($id) {
        $data = Order::find($id);
        $data->status = 'On the Way';
        $data->save();
        return redirect()->back();
    }

    public function delivered($id) {
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect()->back();
    }
}
