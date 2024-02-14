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
  public function chat()
  {
    $data['listChat'] = DB::select('select * from chat c, users u WHERE c.id_user=u.uid and c.id_admin = ' . request()->user()->uid . ' GROUP BY c.id_user');
    // dd($data);
    return view('content.chat.index', $data);
  }

  function getMessageById(Request $request)
  {
    // dd($request->all());
    $data = DB::select("select * from chat c, users u WHERE c.id_user=u.uid and c.id_user = '$request->id_user' and c.id_admin = '" . request()->user()->uid . "' order by c.created_at asc");
    // dd($request->id_user);
    // dd($data);
    echo json_encode($data);
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
    // dd(request()->user()->role);
    if (request()->user()->role == 'pemilik') {
      $data = [
        'id_user' => $request->id_user,
        'id_admin' => request()->user()->uid,
        'message' => $request->msg,
        'type' => 'N',
        'created_at' => now()

      ];
    } else {
      $data = [
        'id_user' => request()->user()->uid,
        'id_admin' =>  $request->uidadmin,
        'message' => $request->msg,
        'type' => 'Y',
        'created_at' => now()

      ];
    }

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
