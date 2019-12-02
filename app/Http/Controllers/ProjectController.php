<?php

namespace App\Http\Controllers;

use App\Project;//importing Project Model
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
      {
        // $projects = Project::where('is_completed', false)
        //                     ->orderBy('created_at', 'desc')
        //                     ->withCount(
        //                         ['tasks' => function ($query) {
        //                       $query->where('is_completed', false);
        //                     }])
        //                     ->get();
        $projects = new Project();
        $projects = $projects->where('is_completed', false)
        ->orderBy('created_at', 'desc')
        ->withCount(
            ['tasks' => function ($query) {
            $query->where('is_completed', false);
        }])->get();
        //Here the task count is the extra array value passed for some functioning
        //f you want to count the number of results 
        //from a relationship without actually loading them you may use the withCount method
        //current project ko task harru false completion bhaye count garxa
        return $projects->toJson();
      }
      public function store(Request $request)
      {
        $validatedData = $request->validate([
          'name' => 'required',
          'description' => 'required',
        ]);

        $project = Project::create([
          'name' => $validatedData['name'],
          'description' => $validatedData['description'],
        ]);
//validates the incoming request data against the defined rules for each field
//Then once the validation passes, 
//we create a new project using the validated data in the database, and return a JSON response.
        return response()->json('Project created!');
      }

      public function show($id)
      {
        $project = Project::with(['tasks' => function ($query) {
          $query->where('is_completed', false);
        }])->find($id);

        return $project->toJson();
      }
      public function markAsCompleted(Project $project)
      {
        $project->is_completed = true;
        $project->update();

        return response()->json('Project updated!');
      }
}
