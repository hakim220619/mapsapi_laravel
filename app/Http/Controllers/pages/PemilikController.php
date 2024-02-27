<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PemilikController extends Controller
{
    public function pemilik()
    {
        $data['pemilik'] = DB::table('users')->where('role', 'pemilik')->get();
        return view('content.pemilik.index', $data);
    }
    function updatePemilik(Request $request)
    {
        // dd($request->all());
        if ($request->file('image')) {
            # code...

            $file_path = public_path() . '/storage/images/jasa/' . $request->image;
            File::delete($file_path);
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('storage/images/jasa'), $filename);
            $data2 = [
                'nama_jasa' => $request->nama_jasa,
                'jenis_jasa' => $request->jenis_jasa,
                'alamat_jasa' => $request->alamat_jasa,
                'image' => $request->file('image')->getClientOriginalName(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];
        } else {
            $data2 = [
                'nama_jasa' => $request->nama_jasa,
                'jenis_jasa' => $request->jenis_jasa,
                'alamat_jasa' => $request->alamat_jasa,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];
        }
        DB::table('jasa')->where('id', $request->id)->update($data2);
        return redirect('/jasaPemilik');
    }
}
