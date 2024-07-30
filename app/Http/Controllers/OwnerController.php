<?php

namespace App\Http\Controllers;
use App\Models\Owner;
use Validator;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(){

        $owners = Owner::select('owners.*', 'roles.RoleName')
        ->leftJoin('roles', 'owners.role_id', '=', 'roles.id')
        ->get();
        if($owners->count() > 0){
       return response()->json([
    'status'=>200,
    'message'=>$owners
     ],200);
        }else{
        return response()->json([
            'status'=>404,
            'message'=> 'No Records Found'
        ],404);

      }

    }



    public function creatOwner(Request $request){
        $validator = Validator::make($request->all(),[

          'firstname' => 'required|string|max:191',
          'lastname' => 'required|string|max:191',
          'phone' => 'required|digits:10',
          'location' => 'required|string|max:191',
          'role_id' => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' =>$validator->messages()

            ],422);
        }else{
            $owners = Owner::create([

                'firstname' => $request->firstname,
                'lastname' =>$request->lastname,
                'phone' =>$request->phone,
                'location' =>$request->location,
                'role_id' =>$request->role_id,

            ]);
            if($owners){
                return response()->json([
                    'status' => 200,
                    'message' => "Owner Created Successfully"

                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Something went wrong!"

                ],404);
            }

        }
    }

    public function showById($id){
        $owners = Owner::find($id);
        if($owners){
            return response()->json([
                'status'=>200,
                'owner'=> $owners

            ],200);
        }else{
            return response()->json([
               'status'=>404,
               'message'=> "No such Owner Found!"
            ],404);
        }

    }

    public function ownerDelete($id){
        $owners = Owner::find($id);
        if($owners){
            $owners->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Ownere Delete Succesefully"
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No such Owners!"
            ],404);
        }
    }
}
