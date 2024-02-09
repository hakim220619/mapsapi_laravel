<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencariController extends Controller
{
    public function pencari()
    {
        $data['pencari'] = DB::table('users')->where('role', 'pencari')->get();
        return view('content.pencari.index', $data);
    }
}
