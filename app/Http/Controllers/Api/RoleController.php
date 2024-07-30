<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index(){
       $role=Role::all();
       if($role->count()>0){
        return response()->json([
            'status'=>200,
            'message'=>$role
        ],200);
       }else{
         return response()->json([
            'status'=>404,
            'message'=>'error'
         ],400);
       }
    }

    public function addRole(Request $request){

        $role=Role::create([
            'RoleName'=>$request->RoleName
        ]);

        if($role){
            return response()->json([
                'status'=>200,
                'message'=>'Role Success'
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Not Success'
            ],404);
        }
    }
}
