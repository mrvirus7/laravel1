<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('student', [StudentController::class, 'index']);
Route::post('student', [StudentController::class, 'store']);
Route::delete('student/{id}',[StudentController::class, 'studentDel']);
Route::get('student/{id}',[StudentController::class,'getByID']);
Route::put('student/{id}',[StudentController::class,'update']);

//Owner route api
Route::get('owners',[OwnerController::class,'index']);
Route::post('owners',[OwnerController::class,'creatOwner']);
Route::get('owners/{id}',[OwnerController::class,'showById']);
Route::delete('owners/{id}',[OwnerController::class,'ownerDelete']);

//project routes api
Route::get('project',[ProjectController::class,'getProject']);
Route::post('project',[ProjectController::class,'create']);

//roles routes api

Route::get('roles',[RoleController::class,'index']);
Route::post('roles',[RoleController::class,'addRole']);
