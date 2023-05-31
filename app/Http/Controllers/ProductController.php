<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with("images")->orderBy("created_at", "DESC");
        if (request()->get("urun")) {
            $products = $products->where("title", "LIKE", "%" . request()->get("urun") . "%");
        }
        $products = $products->paginate(10)->withQueryString();
        return view("back.product-management.products", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.product-management.add-product");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $key => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/upload/products/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        $request->merge([
            "content" => $content
        ]);
        $product = Product::create($request->post());
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
        return redirect()->route("products.index")->withSuccess("Ürün başarıyla eklendi!");
    }

    public function show($slug)
    {
        $product = Product::where("slug", $slug)->first();
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        $selectboxProvinces = DB::table("provinces")->get();
        $funeralCemeteries = DB::table("cemeteries")->get();
        $selectboxCemeteries = DB::table("cemeteries")->get();
        $selectboxOrganisations = DB::table("organisations")->get();
        return view("front.product-detail", compact("product", "countries", "selectboxProvinces", "selectboxCemeteries", "selectboxOrganisations", "jobs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where("slug", $slug)->first();
        return view("back.product-management.edit-product", compact("product"));
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
        $product = Product::find($id);
        if ($request->hasFile("image")) {
            @unlink(public_path($product->image));
            $fileNameWithUpload = FileUpload::disk("/upload/urunler")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload
            ]);
        }
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = 'base64';
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/products/" . time() . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            Product::find($id)->update($request->post());
        } catch (Throwable $e) {
            return redirect()->route("products.index")->withSuccess("Ürün başarıyla güncellendi!");
        }
        return redirect()->route("products.index")->withSuccess("Ürün başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        ProductImage::where("product_id", $id)->delete();
        return back();
    }
}
