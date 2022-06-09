<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Products::all();
        return view('products.registerProduct', compact('products'));
    }

    public function addProduct(Request $request)
    {

        $validated = $request->validate([
            'pname' => 'required|max:255|unique:Products',
            'desc' => 'required|max:255',
            'unit' => 'required|max:10',
            'price' => 'required|numeric',
        ]);

        Products::insert([
            'pname' => $validated['pname'],
            'description' => $validated['desc'],
            'unit' => $validated['unit'],
            'price' => $validated['price'],
        ]);

        return redirect('/products')->with('status', 'Product added successfully');
    }

    public function editProduct(Request $request){
       
       $updateProduct = Products::where('id', $request->pid)->update([
            'pname' => $request->pname,
            'description' => $request->desc,
            'unit' => $request->unit,
            'price' => $request->price,
        ]);

        if($updateProduct){
            return response()->json(['status' => 'success', 'message' => 'Product updated successfully']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        }
        
    }

    public function deleteProduct(Request $request){
         
         $deleteProduct = Products::where('id', $request->pid)->delete();
    
          if($deleteProduct){
                return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
          }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
          }
          
    }
}
