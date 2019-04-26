<?php

namespace App\Http\Controllers;

use App\Inspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;

class InspirationController extends Controller
{
  public function create(Request $request, $image_info) {
    $saveData = [
      "image_info" => $image_info,
      "image_url" => $request->image_url,
      // Yesss, project_id works dynamically here now!!
      "project_id" => Project::where('user_id', Auth::id())->where('active', 1)->first()->id 
    ];
    $inspiration = Inspiration::create($saveData);

    return back();
  }

  public function destroy($image_info) {
    $inspiration = Inspiration::where('image_info', $image_info)->delete();

    return back();
  }
}
