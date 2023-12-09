<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('tecnologies' , 'type')->paginate(20);
        return response()->json($projects);
    }

    public function getProjectBySlug($slug){
// faccio  una query che mi prenda il progetto con lo slug che passo
      $project = Project::where('slug' , $slug)->with('type' , 'tecnologies')->first();
      return response()->json($project);
    }





}
