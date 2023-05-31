<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Throwable;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $product = Product::where("slug", $slug)->first();
        $productImages = $product->images()->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.product-management.product-images", compact("product", "productImages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $product = Product::where("slug", $slug)->first();
        $images = $request->file("image");
        if ($request->hasFile("image")) {
            foreach ($images as $image) {
                $fileNameWithUpload = FileUpload::disk("/upload/urunler")->file($image)->upload();
                ProductImage::create([
                    "product_id" => $product->id,
                    "image" => $fileNameWithUpload
                ]);
            }
        }
        return redirect()->route("products.images.index", $product->slug)->withSuccess("Ürün foroğrafı başarıyla eklendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductImage::find($id)->delete();
        return back();
    }

    public function updateShowRoom(Request $request, $id)
    {
        ProductImage::find($id)->update([
            "showroom" => $request->showroom
        ]);
        return back();
    }
}
