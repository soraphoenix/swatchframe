<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Auth;

class ProjectController extends Controller
{
    public function index() {
      $projects = Project::where('user_id', Auth::id())->get();


      return view('account/projects/index', compact('projects'));
    }
    public function create() {
      return view('account/projects/create');
    }
    public function store(Request $request) {
      $project = new Project;

      if($request->active == 1) {
      Project::where('user_id', Auth::id())->where('active', 1)->update(["active" => 0]);
    }

      $project::create([
        "title" => $request->title,
        "user_id" => Auth::id(),
        "active" => $request->active
      ]);

      return redirect('account/projects');
    }
    public function show($id) {
      $project = Project::where('id', $id)->first();

      return view('account/projects/show', compact('project'));
    }
    public function edit($id) {
      $project = Project::where('id', $id)->first();

      return view('account/projects/edit', compact('project'));
    }
    public function update(Request $request, $id) {

      if($request->active == 1) {
        Project::where('user_id', Auth::id())->where('active', 1)->update(["active" => 0]);
      }

      Project::where('id', $id)->where('user_id', Auth::id())->update(["title" => $request->title, "active" => 1]);


      return back();
    }
    public function destroy($id) {
      $project = Project::where('id', $id)->first();
      if($project->user_id == Auth::id()) {
        $project->deleteRelated();
        return redirect('/account/projects');
      } else {
        return redirect('/account/projects');
      }

    }

}
