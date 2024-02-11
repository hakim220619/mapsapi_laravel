<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];

    // dd($getUser);

    return view('front.home',  ['pageConfigs' => $pageConfigs]);
  }
  function getLotlat()
  {

    $sql = '';
    if (isset(request()->user()->id)) {
      $sql = "and u.id = '" . request()->user()->id . "'";
    }
    $data = DB::select("select * from users u, jasa j where u.uid=j.user_id $sql");
    echo json_encode($data);
  }
  function searchgetLotlat(Request $request)
  {
    // $request = request();
    // dd($request->keywords);
    $sql = '';

    if ($request->keywords) {
      $sql = "and j.nama_jasa like '%" . $request->keywords . "%'";
    }
    $data = DB::select("select * from users u, jasa j where u.uid=j.user_id $sql");
    echo json_encode($data);
  }
  public function dashboard()
  {
    return view('content.pages.pages-home');
  }
}
