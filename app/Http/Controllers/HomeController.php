<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    //
   public function getProject(){
  $home=Project::with('project')->find(1);
  echo $home;
   }
}
