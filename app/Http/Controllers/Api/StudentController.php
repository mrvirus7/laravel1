<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    //
    public function index(){
        $student = Student::all();
       if($student->count() > 0){
        return response()->json([
            'status' => 200,
            'message' => $student
        ],200);
       }else{
        return response()->json([
            'status' => 404,
            'students' => 'No Records Found'
        ],404);
       }


    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required |string|max:191',
            'course' => 'required |string|max:191',
            'email' => 'required |email|max:191',
            'phone' => 'required |digits:10',

        ]);

        if($validator->fails()){
           return response()->json([
            'status' => 400,
            'message' => $validator->messages()
           ], 201);
        }else{
            $student = Student::create([

                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,

            ]);

            if($student){

                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Successfully"

                ],200);

            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong!"
                ],500);

            }

        }
    }

    public function studentDel($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Delete Student Successfully"

            ],200);
        }else{
            return response()->json([
               'status'=>404,
               'message'=>"No such Student"
            ],404);
        }
    }

    public function getByID($id){
        $student=Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'message'=>$student
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"StudentID not found"
            ],500);
        }
    }

    public function update(Request $request,int $id){
        //validation
        $validator = Validator::make($request->all(),[
             'name'=>'required|string|max:100',
             'course'=>'required|string|max:105',
             'email'=>'required|email|max:100',
             'phone'=>'required|digits:10'
        ]);
        if($validator->fails()){

            return response()->json([
                'status'=>422,
                'message'=>$validator->messages()        
            ],422);

        }else{

            $student = Student::find($id);
            if($student){
                $student->update([
                    'name'=>$request->name,
                    'course'=>$request->course,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>"student Update Success"
                ],200);


            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"something wrong"
                ],500);
            }

        }
    }

}
