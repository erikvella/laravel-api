<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('tecnologies' , 'type')->paginate(20);
        return response()->json($projects);
    }

    public function getTypes(){
      $types = Type::all();
      return response()->json($types);
    }

    public function getTecnologies(){
      $tecnologies = Tecnology::all();
      return response()->json($tecnologies);
    }

    public function getProjectBySlug($slug){
// faccio  una query che mi prenda il progetto con lo slug che passo
      $project = Project::where('slug' , $slug)->with('type' , 'tecnologies')->first();
// se è presente l'immagine con il metodo asset ricavo l'URL assoluto
      if($project->image){
        $project->image = asset('storage/' . $project->image);
      }else{
        // se l'immagine non è presente restituisco il placeholder
        $project->image = asset('storage/uploads/placeholder-png.png');
      }

      if($project) $success = true;
      else $success = false;
      return response()->json(compact('project' , 'success'));
    }

    public function getProjectsByType($type_slug){
       $type = Type::where('slug' , $type_slug)->with('projects')->first();
       return response()->json($type);
    }

    public function getProjectsByTecnology($tecnology_slug){
       $tecnology = Tecnology::where('slug' , $tecnology_slug)->with('projects')->first();
       return response()->json($tecnology);
    }





}
