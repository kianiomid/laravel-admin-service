<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Jobs\ProductCreatedJob;
use App\Jobs\ProductDeletedJob;
use App\Jobs\ProductUpdatedJob;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function store()
    {
        $product = Product::create(request()->only(
            'title', 'image'
        ));

        ProductCreatedJob::dispatch($product->toArray())->onQueue('mainservice_queue');

        return response($product, "200");
    }

    public function update($id)
    {
        $product = Product::find($id);
        $product->update(request()->only([
            'title',
            'image'
        ]));

        ProductUpdatedJob::dispatch($product->toArray())->onQueue('mainservice_queue');

        return response($product, "200");
    }

    public function destroy($id)
    {
        Product::destroy($id);
        ProductDeletedJob::dispatch($id)->onQueue('mainservice_queue');
        return response(null, "200");
    }
}
