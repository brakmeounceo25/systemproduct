<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("back-end.category");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
        ]);

        if($validator->passes()){

            // store to database
            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;

            if($request->input("category_image")){

                $tempDir = public_path("uploads/temp/" . $request->input('category_image'));
                $categoryDir = public_path("uploads/category/images/" . $request->input('category_image'));

                if (File::exists($tempDir)) {
                    File::copy($tempDir, $categoryDir);
                    File::delete($tempDir);
                }

                $category->image = $request->input('category_image');
            }

            $category->save();

            return response()->json([
                "status" => 200,
                "message" => "Category added successfully",
            ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Failed to add category",
                "errors" => $validator->errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function list()
    {
        $category = Category::orderBy('id','DESC')->get();

        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);

        if($category == null){
            return response()->json([
                'status' => 404,
                'message' => "Failed to remove category"+$request->id,
            ]);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => "Successfully removed category"
        ]);
    }

    /**
     * Upload category image products.
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);

       if($validator->passes()){
            $file = $request->file('image');

            $imageName = rand(0, 99999999999) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/temp', $imageName);

            return response()->json([
                'status' => 200,
                'message' => 'Image uploaded successfully',
                'image' => $imageName
            ]);
        }    
        else{
            return response()->json([
                'status' => 404,
                'error' => $validator->errors()
            ]); 
        }
    }

    public function cancel(Request $request){
        if($request->image){
            $tempDir = public_path("uploads/temp/$request->image");

            if(File::exists($tempDir)){
                File::delete($tempDir);

                return response()->json([
                    'status' => 200,
                    'message' => 'Image cancelled upload success',
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        if($category == null){
            return response()->json([
                'status' => 404,
                'message' => 'Edit not found with id ' . $request->id,
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'category' => $category
            ]); 
        }       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $category = Category::find($request->category_id);

        if($category == null){
            return response()->json([
                'status' => 404,
                'message' => 'Edit not found with id '. $request->id,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name' . $request->id,
        ]);

        if($validator->passes()){
            // update category //
            $category->name = $request->name;
            $category->status = $request->status;

            if(!empty($request->input('category_image'))){

                $tempDir = public_path("uploads/temp/" . $request->input('category_image'));
                $categoryDir = public_path("uploads/category/images/" . $request->input('category_image'));

                if (File::exists($tempDir)) {
                    File::copy($tempDir, $categoryDir);
                    File::delete($tempDir);
                }

                // Remove old category images directory
                $categoryDir = public_path("uploads/category/images/" .$category->image);
                if(File::exists($categoryDir)) {
                    File::delete($categoryDir);
                }

                $image = $request->input('category_image');
                
            }
            else if($request->input('old_image')){
                $image = $request->input('old_image');
            }

            $category->image = $image;

            $category->save();

            return response()->json([
                "status" => 200,
                "message" => "Category updated successfully",
            ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Failed to add category",
                "errors" => $validator->errors(),
            ]);
        }
    }
}
