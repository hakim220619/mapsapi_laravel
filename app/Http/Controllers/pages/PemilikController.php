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
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tlp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'role' => 'required|string|max:50',
        ]);

        // Cari data pemilik berdasarkan ID

        // Update data pemilik
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data pemilik berhasil diperbarui.');
    }

    // Fungsi untuk menghapus data pemilik
    public function destroy($id)
    {
        // Cari data pemilik berdasarkan ID
        DB::table('users')->where('id', $id)->delete();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data pemilik berhasil dihapus.');
    }
}
