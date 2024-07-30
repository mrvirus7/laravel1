<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use Validator;

class ProjectController extends Controller
{
    //

    public function getProject(){
        $project = Project::select(
            'owners3.firstname as NAMEFirstName',
            'owners3.lastname as NAMELastName',
            'project.ProjectName',
            Project::raw("COALESCE(owners1.firstname, 'N/A') as PrimarySuccessorFirstname"),
        Project::raw("COALESCE(owners1.lastname, 'N/A') as PrimarySuccessorLastname"),
        Project::raw("COALESCE(owners2.firstname, 'N/A') as SecondarySuccessorFirstname"),
        Project::raw("COALESCE(owners2.lastname, 'N/A') as SecondarySuccessorLastname")
        )
        ->join('owners as owners3', 'project.Name', '=', 'owners3.id')
        ->leftjoin('owners as owners1', 'project.PrimarySuccessor', '=', 'owners1.id')
        ->leftjoin('owners as owners2', 'project.SecondarySuccessor', '=', 'owners2.id')

        ->get();

       if($project->count() > 0){
        return response()->json([
            'status'=>200,
            'message'=>$project
        ],200);
       }else{
        return response()->json([
            'status' => 404,
            'message' => "Data Not Found"

        ],404);
       }

}


public function create(Request $request){

    $project = Project::create([
        'Name'=>$request->Name,
        'ProjectName'=>$request->ProjectName,
        'PrimarySuccessor' =>$request->PrimarySuccessor,
        'SecondarySuccessor' =>$request->SecondarySuccessor,
    ]);
    if($project){
        return response()->json([
            'status'=>200,
            'message'=>'success insert'
        ],200);
    }else{
        return response()->json([
            'status'=>404,
            'message'=>"Fail to Insert"

        ],404);
    }
}
}
