<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Http\Requests\FormProductRequest;


class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('products/index', []);
    }
    public function create()
    {
        return Inertia::render('products/form', [
            'product' => new Product(),
        ]);
    }
    public function store(FormProductRequest $request)
    {
        Product::create($request->validated());
        return to_route('products.index');
        // ->with('success', 'Product created successfully.');
    }
}
