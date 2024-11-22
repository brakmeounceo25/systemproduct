<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        return view('back-end.product');
    }

    // data relational
    public function data(){
        $categories = Category::orderBy('id','DESC')->get();
        $brands     = Brand::orderBy('id','DESC')->get();
        $colors     = Color::orderBy('id', 'DESC')->get();

        return response()->json([
            'status'  => 200,
            'message' => 'Product selected data is saved first',
            'data'    => [
                'categories' => $categories,
                'brands'     => $brands,
                'colors'     => $colors,
            ]
        ]);
    }

    // store product to database
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'qty'   => 'required|numeric',
            'desc'   => 'required',
            'image_uploads.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->passes()){
            $product = new Product();
            $product->title       = $request->title;
            $product->desc        = $request->desc;
            $product->price       = $request->price;
            $product->qty         = $request->qty;
            $product->category_id = $request->category;
            $product->brand_id    = $request->brand;
            $product->color       = implode(",", $request->color); // 1, 2, 3 = "1,2,3"
            $product->user_id     = Auth::user()->id;
            $product->status      = $request->status;

            $product->save();

            if($request->image_uploads != null){
                $images = $request->image_uploads;
                foreach($images as $img){
                    $image = new ProductImage();
                    $image->image = $img;
                    $image->product_id = $product->id;
                    // Move image to product dir
                    if(File::exists(public_path("uploads/temp/$img"))){
                        // Copy image to product dir
                        File::copy(public_path("uploads/temp/$img"), public_path("uploads/products/$img"));
                        // Delete image product dir
                        File::delete(public_path("uploads/temp/$img"));
                    }
                    $image->save();
                }
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Product saved successfully',
            ]);

        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Product saved Unsuccessfully',
                'errors' => $validator->errors()
            ]);
        }
    }

    // list all products
    public function list(Request $request){
        $products = Product::orderBy('id', 'DESC')->with(['Images', 'Categories', 'Brands']);
        if($request->search != null){
            $products = Product::with(['Images', 'Categories', 'Brands'])
            ->where('name', 'like', '%' . $request->search . '%')
            ->orWhereHash('Categories', function ($field) use ($request) {
                $field->where('name', 'like', '%' . $request->serach . '%');
            })
            ->orWhereHash('Brands', function ($field) use ($request) {
            $field->where('name', 'like', '%' . $request->search . '%');
            })->get();    
        }else{
             $products = Product::orderBy('id', 'DESC')->with(['Images', 'Categories', 'Brands']);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Products selected successfully',
            'products' => $products
        ]);
    }

    // edit product in database
    public function edit(Request $request){
        $product = Product::find($request->id);     
        $productImage = ProductImage::where('product_id',$request->id)->get();
        $categories = Category::orderBy('id', 'DESC')->get();
        $brands     = Brand::orderBy('id', 'DESC')->get();
        $colors     = Color::orderBy('id', 'DESC')->get();

        return response()->json([
            'status'  => 200,
            'message' => 'Products edited successfully',
            'data' => [
                'product' => $product,
                'productImage' => $productImage ,
                'categories' => $categories,
                'brands'     => $brands,
                'colors'     => $colors,
            ]
        ]);
    }

    // update product in database
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'qty'   => 'required|numeric',
            'desc'   => 'required',
        ]);

        if ($validator->passes()) {
            $product = new Product();
            $product->title       = $request->title;
            $product->desc        = $request->desc;
            $product->price       = $request->price;
            $product->qty         = $request->qty;
            $product->category_id = $request->category;
            $product->brand_id    = $request->brand;
            $product->color       = implode(",", $request->color); // 1, 2, 3 = "1,2,3"
            $product->user_id     = Auth::user()->id;
            $product->status      = $request->status;

            $product->save();

            if ($request->file('image_uploads') != null) {
                $images = $request->file('image_uploads');
                foreach ($images as $img) {
                    $image = new ProductImage();
                    $image->image = $img;
                    $image->product_id = $product->id;
                    // Move image to product dir
                    if (File::exists(public_path("uploads/temp/$img"))) {
                        // Copy image to product dir
                        File::copy(public_path("uploads/temp/$img"), public_path("uploads/product/$img"));
                        // Delete image product dir
                        File::delete(public_path("uploads/temp/$img"));
                    }
                    $image->save();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Product saved successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product saved Unsuccessfully',
                'errors' => $validator->errors()
            ]);
        }
    }

    // delete product in database
    public function destroy(Request $request){
        $product = Product::find($request->id);
        
        $product->delete();

        return response()->json([
            'status'  => 200,
            'message' => 'Products deleted successfully',
        ]);
    }
}
