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

      $keyword = $request->search;


      return redirect('search/'.urlencode($keyword));
    }

    public function search(Request $request, $keyword) {

      $client = new Client();

      $res = $client->request('GET', "https://api.behance.net/v2/projects?q=".urlencode($keyword)."&client_id=".env('BEHANCE_KEY')."&field=".urlencode("web design"));

      $data = $res->getBody();
      $data = json_decode($data);
      $filteredData = $data->projects;

      $inspirationsArray = Project::where('user_id', Auth::id())->where('active', 1)->first();
      // return var_dump($inspirationsArray);
      $inspirationsArray = $inspirationsArray->inspirations;
      $arrayInfo = [];

      foreach($inspirationsArray as $image) {
        array_push($arrayInfo, $image->image_info);
      }

      // return $filteredData;

      $user = Auth::user();
      return view('pages/results', compact('user', 'filteredData', 'keyword', 'arrayInfo'));
    }
}
