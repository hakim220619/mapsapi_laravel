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

    $data = DB::select("select * from users u, jasa j where u.uid=j.user_id");
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

  function messgaeSend(Request $request)
  {
    $data = [
      'id_user' => request()->user()->uid,
      'id_admin' => $request->uidadmin,
      'message' => $request->msg,
      'type' => 'Y',
      'created_at' => now()

    ];
    DB::table('chat')->insert($data);
    return response()->json([
      'succes' => true,
      'message' => $request->msg,
      'uid' => $request->uidadmin
    ]);
  }

  function getMessage(Request $request)
  {

    $data = DB::select("select * from chat where id_admin = '$request->id_admin' and id_user = '" . request()->user()->uid . "'");
    echo json_encode($data);
  }
  public function dashboard()
  {
    return view('content.pages.pages-home');
  }
}
