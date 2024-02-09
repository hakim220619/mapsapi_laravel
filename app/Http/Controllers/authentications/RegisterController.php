<?php

namespace App\Http\Controllers\authentications;

use Adrianorosa\GeoLocation\GeoLocation as GeoLocationGeoLocation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    public function pemilik(Request $request)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        $response = HTTP::get('https://geolocation-db.com/json/');

        // $response->toArray();
        // dd(json_decode($response->body()));
        // $latitude = $collection->latitude;

        return view('content.authentications.register-pemilik', ['pageConfigs' => $pageConfigs, 'maps' => json_decode($response->body())]);
    }
    public function pencari()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.register-pencari', ['pageConfigs' => $pageConfigs]);
    }
    function pemilik_add(Request $request)
    {
        $id = rand(0000, 9999);
        $data = [
            'uid' => $id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tlp' => $request->tlp,
            'role' => 'pemilik',
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ];
        DB::table('users')->insert($data);

        $file_path = public_path() . '/storage/images/jasa/' . $request->image;
        File::delete($file_path);
        $image = $request->file('image');
        $filename = $image->getClientOriginalName();
        $image->move(public_path('storage/images/jasa'), $filename);
        $data2 = [
            'user_id' => $id,
            'nama_jasa' => $request->nama_jasa,
            'jenis_jasa' => $request->jenis_jasa,
            'alamat_jasa' => $request->alamat_jasa,
            'image' => $request->file('image')->getClientOriginalName(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_at' => now(),
        ];
        DB::table('jasa')->insert($data2);
        return redirect('/');
    }
    function pencari_add(Request $request)
    {
        $id = rand(0000, 9999);
        $data = [
            'uid' => $id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat,
            'role' => 'pencari',
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ];
        DB::table('users')->insert($data);
        return redirect('/');
    }
}
