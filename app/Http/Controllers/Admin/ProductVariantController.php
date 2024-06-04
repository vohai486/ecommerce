<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

        // $product = Product::where(['id' => $id])->with([
        //     'variants' => function ($query) {
        //         return $query->orderBy('price', 'desc');
        //     }
        // ])->first();

        $product = Product::where(['id' => $id])
            ->with(['variants'])
            ->first();
        return view('admin.product.variants.index', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'integer']
        ], [
            'required' => 'Vui lòng nhập',
            'size' => 'Không được quá :max kí tự',
            'integer' => 'Phải là số nguyên',
            'numeric' => 'Phải là số',
        ]);
        $variant = ProductVariant::create($request->only(['name', 'price', 'product_id']));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProductVariant::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
