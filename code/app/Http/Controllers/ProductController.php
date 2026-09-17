<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();
        $keyword = $request->get('search');
        if ($keyword != null && $keyword != '') {
            $products->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->orderBy('id', 'DESC')->paginate(10);

        }

        return Inertia::render('products/index', [
            'search' => $keyword,
            'collection' => ProductResource::collection(
                $products->orderBy('id', 'DESC')->paginate(10)
            ),
        ]);
    }

    public function create()
    {
        return Inertia::render('products/form', [
            'product' => new Product,
        ]);
    }

    public function store(FormProductRequest $request)
    {
        Product::create($request->validated());

        return to_route('products.index')->with('message', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('products/form', [
            'product' => new ProductResource($product),
        ]);
    }

    public function update(FormProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return to_route('products.index')->with('message', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('message', 'Product deleted successfully.');
    }
}
