<?php

namespace App\Http\Controllers;

use Session;
use App\Lowongan;
use App\User;
use App\Lamaran;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lar = Lamaran::with('Lowongan','User')->get();
        return view('lamaran.index',compact('lar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $us = User::all();
        return view('lamaran.create',compact('us'));
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
            'file_cv' => 'required|',
            'status' => 'required|',
            'low_id' => 'required|',
            'user_id' => 'required|'
        ]);
        $lar = new Lamaran;
        $lar->file_cv = $request->file_cv;
        $lar->status = $request->status;
        $lar->low_id = $request->low_id;
        $lar->user_id = $request->user_id;
        $lar->save();
        // attach fungsinya untuk melampirkan data,yang dilampirkan disini ialah data dari method Pesanan
        //  yang ada di model pengantin
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$per->file_cv</b>"
        ]);
        return redirect()->route('lamaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function show(Lamaran $lamaran)
    {
        $lar = Lamaran::findOrFail($id);
        return view('lamaran.show',compact('lar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lamaran $lamaran)
    {
        $lar = Lamaran::findOrFail($id);
        $low   = Lowongan::all();
        $us= User::all();
        $selectedus = Perusahaan::findOrFail($id)->user_id;
        // dd($selected);
        return view('perusahaan.edit',compact('lar','per','low','selectedlow','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lamaran $lamaran)
    {
         $this->validate($request,[
            'file_cv' => 'required|',
            'status' => 'required|',
            'low_id' => 'required|',
            'user_id' => 'required|'
        ]);
        $lar = Lamaran::findOrFail($id);
        $lar->file_cv = $request->file_cv;
        $lar->status = $request->status;
        $lar->low_id = $request->low_id;
        $lar->user_id = $request->user_id;
        $lar->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$per->file_cv</b>"
        ]);
        return redirect()->route('lamaran.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lamaran $lamaran)
    {
        $lar = Lamaran::findOrFail($id);
        $lar->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('lamaran.index');
    }
}
