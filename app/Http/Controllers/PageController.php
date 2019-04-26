<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Project;

// public function __construct()
// {
//     $this->middleware('auth');
// }

class PageController extends Controller
{
    public function index() {
      $user = Auth::user();
      return view('pages/home', compact('user'));
    }

    public function results(Request $request) {
      // 'https://api.behance.net/v2/projects?q=motorcycle&client_id=fp3qDsbE1Dije57MpcLWMIlLAfilKyHd'

      $search = $request->search;


      return redirect('search/'.urlencode($search));
    }

    public function search(Request $request, $keyword) {

      $client = new Client();

      $res = $client->request('GET', "https://api.behance.net/v2/projects?q=".urlencode($keyword)."&client_id=".env('BEHANCE_KEY')."&field=".urlencode("web design"));

      $data = $res->getBody();
      $data = json_decode($data);
      $filteredData = $data->projects;

      $arrayInfo = [];
      // I'll have to come back to this if statement later to make sure it's appropriate
      if($inspirationsArray = Project::where('user_id', Auth::id())->where('active', 1)->first()) {
      // return $inspirationsArray;
      $inspirationsArray = $inspirationsArray->inspirations;

      foreach($inspirationsArray as $image) {
        array_push($arrayInfo, $image->image_info);
      }
    }
      
      // return $inspirationsArray; // Here to test if there's any data under the different conditions
      // return $filteredData;
      $user = Auth::user();
      return view('pages/results', compact('user', 'filteredData', 'keyword', 'arrayInfo'));
    }
}
