<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    public function pemilik()
    {
        $data['pemilik'] = DB::table('users')->where('role', 'pemilik')->get();
        return view('content.pemilik.index', $data);
    }
}
