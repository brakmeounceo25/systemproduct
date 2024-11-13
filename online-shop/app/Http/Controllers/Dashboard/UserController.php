<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return view("back-end.user");
    }

    public function list(){
        $user = User::orderBy('id', 'DESC')->get();

        return response([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        if($validator->passes()){
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->role = $request->role;

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'User added successfully!',
            ]);
        }
        else{
            return response()->json([
               'status' => 404,
                'message' => 'User added Unsuccessfully!',
                'errors' => $validator->errors()
            ]);
        }
    }    

    public function destroy(Request $request){
        $user = User::find($request->id);

        if($user == null){
            return response()->json([
                'status' => 404,
                'message' => 'Delete user not found id'+$request->id,
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully',
        ]);
    }
}
