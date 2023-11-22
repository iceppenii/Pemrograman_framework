<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//panggil model BukuModel
use App\Models\AnggotaModel;

class AnggotaController extends Controller
{
    //method untuk tampil data anggota
    public function anggotatampil()
    {
        $dataanggota = AnggotaModel::orderby('id_anggota', 'ASC')
        ->paginate(5);

        return view('halaman/view_anggota',['anggota'=>$dataanggota]);
    }

    //method untuk tambah data anggota
    public function anggotatambah(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'nama_anggota' => 'required',
            'pekerjaan' => 'required',
            'hp' => 'required'
        ]);

        AnggotaModel::create([
            'nik' => $request->nik,
            'nama_anggota' => $request->nama_anggota,
            'pekerjaan' => $request->pekerjaan,
            'hp' => $request->hp
        ]);

        return redirect('/anggota');
    }

     //method untuk hapus data anggota
     public function anggotahapus($id_anggota)
     {
         $dataanggota=AnggotaModel::find($id_anggota);
         $dataanggota->delete();
 
         return redirect()->back();
     }

     //method untuk edit data anggota
    public function anggotaedit($id_anggota, Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'nama_anggota' => 'required',
            'pekerjaan' => 'required',
            'hp' => 'required'
        ]);

        $id_anggota = AnggotaModel::find($id_anggota);
        $id_anggota->nik   = $request->nik;
        $id_anggota->nama_anggota      = $request->nama_anggota;
        $id_anggota->pekerjaan  = $request->pekerjaan;
        $id_anggota->hp   = $request->hp;

        $id_anggota->save();

        return redirect()->back();
    }
}