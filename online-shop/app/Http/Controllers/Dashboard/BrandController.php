<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index() {
        $categories = Category::orderBy('id','DESC')->get();
        return view('back-end.brand', compact('categories'));
    }

    // Store the brand to database
    public function store(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands,name',
        ]);

        if($validator->passes()){
            $brand = new Brand();
            
            $brand->name = $request->name;
            $brand->category_id = $request->category_id;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => 200,
                'message' => 'Store brand successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Please check store brand to database',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function list(Request $request) {

        $limit = 5;
        $page = $request->page; // 2
        $offset = ($page - 1) * $limit;

        if(!empty($request->search)){
            $brands = Brand::where('name', 'like' ,'%'.$request->search.'%')
                            ->orderBy('id','DESC')
                            ->with('category')
                            ->limit(5)
                            ->offset($offset)
                            ->get();
            $totalRecord = Brand::where('name', 'like' ,'%'.$request->search.'%')->count();
        }
        else{
            $brands = Brand::orderBy('id', 'DESC')
                ->with('category')
                ->limit(5)
                ->offset($offset)
                ->get();
            $totalRecord = Brand::count();
        }

        // Total Record
        // $totalRecord = Brand::count();
        $totalPage = ceil($totalRecord / 5); // 2.1 => 3

        return response()->json([
           'status' => 200,
            'page' => [
                'totalRecord' => $totalRecord,
                'totalPage' => $totalPage,
                'currentPage' => $page,
            ],
            'brands' => $brands,
        ]);
    }

    public function edit(Request $request){
        
        $brand = Brand::find($request->id);

        if($brand == null){
            return response()->json([
                'status' => 404,
                'message' => 'Please check edit brand with id' . $request->id,
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'brand' => $brand
            ]);
        }
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands,name'
        ]);

        if($validator->passes()){
            $brand = Brand::find($request->brand_id);

            if ($brand == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please check update brand with id' . $request->brand_id,
                ]);
            }

            $brand->name = $request->name;
            $brand->category_id = $request->category;
            $brand->status = $request->status;

            $brand->update();

            return response()->json([
                'status' => 200,
                'message' => 'Brand updated successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => 501,
                'message' => 'Please check store brand to database',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request){
        
        $brand = Brand::find($request->id);

        if($brand == null){
            return response()->json([
                'status' => 404,
                'message' => 'Please check delete brand with id' . $request->id,
            ]);
        }
        else{
            $brand->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Brand deleted successfully',
            ]);
        }
        
    }
}
