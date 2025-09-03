<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Checking for assets
     */
    public function assetsChecker($entry, $request)
    {
        // Checking for sample
        if($request->hasFile('image')){

            // Deleting existing image
            Storage::delete($entry->image);
            Storage::delete($entry->image_medium);
            Storage::delete($entry->image_small);

            // Thumbnail Maker
            $dimension = [
                'medium' => [
                    'width' => 320,
                    'height' => 180,
                ],
                'small' => [
                    'width' => 240,
                    'height' => 135,
                ]
            ];
            $path = "products";
            $thumbnail = Thumbnail::make($request->image, $dimension, $path);

            // Updating Image Paths
            $entry->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }
    }

    public function store(StoreProductRequest $request)
    {
        $request->validate([
            "visible" => 'required',
            'brand' => 'required',
            'category' => 'required',
            'title' => 'required',
            'url' => 'required|unique:products',
            'image' => 'required|image',
        ]);
    
        $product = Product::create([
            "visible" => $request->visible,
            "featured" => $request->featured,
            'brand_id' => $request->brand,
            'branch_id' => $request->branch,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
    
            'title' => $request->title,
            'url' => $request->url,
            'price' => $request->price,
            'regular_price' => $request->regular_price,
            'quantity' => $request->quantity,
    
            'short_description' => $request->short_description,
            'overview' => $request->overview,
            'features' => $request->features,
            'specifications' => $request->specifications,
            'includes' => $request->includes,
            'accessories' => $request->accessories,
    
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
    
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($product, $request);
    
        return back()->with('status', 'Stored!');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            "visible" => $request->visible,
            "featured" => $request->featured,
            'brand_id' => $request->brand,
            'branch_id' => $request->branch,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
    
            'title' => $request->title,
            'url' => $request->url,
            'price' => $request->price,
            'regular_price' => $request->regular_price,
            'quantity' => $request->quantity,
    
            'short_description' => $request->short_description,
            'overview' => $request->overview,
            'features' => $request->features,
            'specifications' => $request->specifications,
            'includes' => $request->includes,
            'accessories' => $request->accessories,
    
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
    
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($product, $request);
    
        return back()->with('status', 'Updated!');
    }
}
