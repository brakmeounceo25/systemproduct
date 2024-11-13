<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index(){
        return view("back-end.color");
    }

    // Store the brand to database
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:colors,name',
        ]);

        if ($validator->passes()) {
            $brand = new Color();

            $brand->name = $request->name;
            $brand->color_code = $request->color_code;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => 200,
                'message' => 'Store color successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Please check store color to database',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function list(Request $request)
    {

        $limit = 5;
        $page = $request->page; // 2
        $offset = ($page - 1) * $limit;

        if (!empty($request->search)) {
            $colors = Color::where('name', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->offset($offset)
                ->get();
            $totalRecord = Color::where('name', 'like', '%' . $request->search . '%')->count();
        } else {
            $colors = Color::orderBy('id', 'DESC')
                ->limit(5)
                ->offset($offset)
                ->get();
            $totalRecord = Color::count();
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
            'colors' => $colors,
        ]);
    }

    public function edit(Request $request)
    {

        $color = Color::find($request->id);

        if ($color == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Please check edit brand with id' . $request->id
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'color' => $color
            ]);
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:colors,name' . $request->color_id
        ]);

        if ($validator->passes()) {
            $color = Color::find($request->color_id);

            if ($color == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please check update color with id' . $request->color_id
                ]);
            }

            $color->name = $request->name;
            $color->color_code = $request->color_code;
            $color->status = $request->status;

            $color->update();

            return response()->json([
                'status' => 200,
                'message' => 'Color updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 501,
                'message' => 'Please check store color to database',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request)
    {

        $color = Color::find($request->id);

        if ($color == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Please check delete color with id' . $request->id,
            ]);
        } else {
            $color->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Color deleted successfully',
            ]);
        }
    }
}
