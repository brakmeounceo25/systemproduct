<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function uploads(Request $request){
        if($request->hasFile('image')){
            $files = $request->file('image');

            $images = [];
            foreach($files as $file){
                $fileName = rand(0,9999999999) . '.' . $file->getClientOriginalExtension();
                $images[] = $fileName;
                $file->move(public_path("uploads/temp"), $fileName);
            }
            

            return response()->json([
                'status' => 200,
                'message' => 'Image uploaded successfully',
                'images' => $images
            ]);
        }
        else{
            return response()->json([
               'status' => 404,
               'message' => 'Image uploads unsuccessfully '
            ]);
        }
    }

    public function cansel(Request $request){
        $temp_path = public_path("uploads/temp/".$request->image);
        $product_path = public_path("uploads/products/images/" . $request->image);

        if(File::exists($temp_path) || File::exists($product_path)){
            File::delete($temp_path);

            return response()->json([
                'status' => 200,
                'message' => 'Image Cancelled successfully',
            ]);
        }else if (File::exists($product_path)) {
            File::delete($product_path);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'Cancelled image not found'
            ]);
        }
    }
}
