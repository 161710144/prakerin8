<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\User;
use Session;
use File;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per = Perusahaan::with('User')->get();
        return view('perusahaan.index',compact('per'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $per = User::all();
        return view('perusahaan.create',compact('per'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|',
            'tgl_mulai' => 'required|',
            'email' => 'required|unique:perusahaans',
            'telepon' => 'required|',
            'user_id' => 'required|'
        ]);
        $per = new Perusahaan;
        $per->logo = $request->logo;
        $per->deskripsi = $request->deskripsi;
        $per->kategori = $request->kategori;
        $per->subkategori = $request->subkategori;
        $per->judul = $request->judul;
        $per->gaji = $request->gaji;
        $per->tgl_mulai = $request->tgl_mulai;
        $per->email = $request->email;
        $per->telepon = $request->telepon;
        $per->user_id = $request->user_id;    
        $per->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$per->logo</b>"
        ]);
        // upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $destinationPath = public_path().'/assets/img/logopers/';
            $uploadSucces = $file->move($destinationPath, $filename);
            $per->logo = $filename;
        }
        $per->save();
        return redirect()->route('perusahaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $per = Perusahaan::findOrFail($id);
        return view('perusahaan.show',compact('per'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $per = Perusahaan::findOrFail($id);
        $us = User::all();
        $selectedus = Perusahaan::findOrFail($id)->user_id;
        // dd($selected);
        return view('perusahaan.edit',compact('per','us','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|',
            'tgl_mulai' => 'required|',
            'email' => 'required|',
            'telepon' => 'required|',
            'user_id' => 'required|'
        ]);
        $per = Perusahaan::findOrFail($id);
        $per->logo = $request->logo;
        $per->deskripsi = $request->deskripsi;
        $per->kategori = $request->kategori;
        $per->subkategori = $request->subkategori;
        $per->judul = $request->judul;
        $per->gaji = $request->gaji;
        $per->tgl_mulai = $request->tgl_mulai;
        $per->email = $request->email;
        $per->telepon = $request->telepon;
        $per->user_id = $request->user_id;
        $per->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$per->logo</b>"
        ]);
        //edit upload foto
        if ($request->hasFile('logo')){
            $file = $request->file('logo');
            $destinationPath = public_path().'/assets/img/logopers/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSucces = $file->move($destinationPath, $filename);

            //hapus foto lama
            if ($per->logo){
                $old_logo = $per->logo;
                $filepath = public_path() . DIRECTORY_SEPARATOR . '/assets/img/logopers/' . DIRECTORY_SEPARATOR .$per->logo;
                try{
                    File::delete($filepath);
                }catch (FileNotFoundException $p){
                    //file sudah dihapus
                }
            }
            $per->logo = $filename;
        }
        return redirect()->route('perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $per = Perusahaan::findOrFail($id);
        $per->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('perusahaan.index');
    }
}
