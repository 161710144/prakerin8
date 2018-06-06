<?php

namespace App\Http\Controllers;

use Session;
use App\Perusahaan;
use App\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $low = Lowongan::with('Perusahaan')->get();
        return view('lowongan.index',compact('low'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $per = Perusahaan::all();
        return view('lowongan.create',compact('per'));
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
            'nama_low' => 'required|max:225',
            'tgl_mulai' => 'required|',
            'lokasi' => 'required|max:225',
            'gaji' => 'required|',
            'deskripsi_iklan' => 'required|max:225',
            'pers_id' => 'required'
        ]);
        $low = new Lowongan;
        $low->nama_low = $request->nama_low;
        $low->tgl_mulai = $request->tgl_mulai;
        $low->lokasi = $request->lokasi;
        $low->gaji = $request->gaji;
        $low->deskripsi_iklan = $request->deskripsi_iklan;
        $low->pers_id = $request->pers_id;
        $low->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$low->deskripsi</b>"
        ]);
        return redirect()->route('lowongan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function show(Lowongan $lowongan)
    {
        $low= Lowongan::findOrFail($id);
        return view('lowongan.show',compact('low'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $low = Lowongan::findOrFail($id);
        $per = Perusahaan::all();
        $selectedper = Lowongan::findOrFail($id)->low_id;
        return view('lowongan.edit',compact('per','low','selectedper'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_low' => 'required|max:225',
            'tgl_mulai' => 'required|',
            'lokasi' => 'required|max:255',
            'gaji' => 'required|',
            'deskripsi_iklan' => 'required|max:225',
            'pers_id' => 'required|'
        ]);
        $low = Lowongan::findOrFail($id);
        $low->nama_low = $request->nama_low;
        $low->tgl_mulai = $request->tgl_mulai;
        $low->lokasi = $request->lokasi;
        $low->gaji = $request->gaji;
        $low->deskripsi_iklan = $request->deskripsi_iklan;
        $low->pers_id = $request->pers_id;
        $low->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$low->nama_low</b>"
        ]);
        return redirect()->route('lowongan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $low = Lowongan::findOrFail($id);
        $low->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('lowongan.index');
    }
}
