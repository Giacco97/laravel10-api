<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        if($users->count() > 0){

            return response()->json([
                'status' => 200,
                'users' => $users
            ], 200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);

        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if($validator->fails()){

                return response ()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
        }else{

            $users = Users::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if($users){

                return response()->json([
                    'status' => 200,
                    'message' => "Users Created Successfully"
                ],200);

            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ],500);
            }
        }

    }

    public function show($id)
    {
        $users = Users::find($id);
        if($users){

            return response()->json([
                'status' => 200,
                'users' => $users
                
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Users ID Found"
            ],404);

        }
    }

    public function edit($id)
    {
        $users = Users::find($id);
        if($users){

            return response()->json([
                'status' => 200,
                'users' => $users
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Users ID Found"
            ],404);

        }

    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if($validator->fails()){

                return response ()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
        }else{

            $users = Users::find($id);
            if($users){

                $users->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Users Updated Successfully"
                ],200);

            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Users"
                ],404);
            }
        }

    }
    
    public function delete ($id)
    {
          $users = Users::find($id);
            if($users){
                $users->delete();
                return response()->json([
                    'status' => 200,
                    'message' => "User Delete"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Users"
                ],404);
            }
    }

}
