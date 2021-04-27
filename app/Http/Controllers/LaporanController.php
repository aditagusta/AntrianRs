<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_booking' => 'required',
            'catatan1' => 'required',
            'catatan2' => 'required',
        );
    }

    public function index()
    {
        $data['laporan'] = DB::table('booking')
        ->leftJoin('member','booking.id_member','member.id_member')
        ->leftJoin('catatan','booking.id_booking','catatan.id_booking')
        ->select('booking.*','member.nama_member','catatan.catatan1','catatan.catatan2')
        ->get();
        return view('pages.laporan.index',$data);
    }

    public function add(Request $request)
    {
        $data = DB::table('catatan')
        ->insert([
            'id_booking' => $request->id_booking,
            'catatan1' => $request->catatan1,
            'catatan2' => $request->catatan2,
        ]);
        if($data == TRUE)
        {
            return redirect('data/laporan')->with('success','Berhasil Menambahkan Hasil Tes');
        } else {
            return back()->with('success','Gagal Menambahkan Hasil Tes');
        }
    }

    public function get(Request $request, $id)
    {
        $data = DB::table('booking')
        ->leftJoin('member','booking.id_member','member.id_member')
        ->leftJoin('catatan','booking.id_booking','catatan.id_booking')
        ->where('booking.id_booking', $id)->first();
        return view('pages.laporan.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $data = DB::table('catatan')
        ->where('id_booking', $request->id_booking)
        ->update([
            'catatan1' => $request->catatan1,
            'catatan2' => $request->catatan2
        ]);
        if($data == TRUE)
        {
            return redirect('data/laporan')->with('success','Berhasil Menambahkan Hasil Tes');
        } else {
            return back()->with('success','Gagal Menambahkan Hasil Tes');
        }
    }

    public function formadd(Request $request, $id)
    {
        $data = DB::table('booking')->join('member','booking.id_member','member.id_member')->where('id_booking', $id)->first();
        return view('pages.laporan.tambah',compact('data'));
    }

    //
    public function dataLaporan()
    {
        $id_member = Auth::guard('member')->user()->id_member;
        $data = DB::table('booking')
        ->leftJoin('member','booking.id_member','member.id_member')
        ->leftJoin('catatan','booking.id_booking','catatan.id_booking')
        ->select('booking.*','member.nama_member','catatan.catatan1','catatan.catatan2')
        ->where('booking.id_member', $id_member)
        ->get();
        if($data == TRUE)
        {
            return response()->json(['status' => 200,'message' => 'Data Ditemukan', 'data' => $data]);
        } else {
            return response()->json(['status' => 404,'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function saranMember(Request $request)
    {
        $id_member = Auth::guard('member')->user()->id_member;
        $today = date('Y-m-d');
        $data = DB::table('saran')
        ->insert([
            'id_member' => $id_member,
            'saran' => $request->saran,
            'tanggal_saran' => $today
        ]);
        if($data == TRUE)
        {
            return response()->json(['status' => 200,'message' => 'Terima Kasih Masukkan Saran Anda', 'data' => $data]);
        } else {
            return response()->json(['status' => 404,'message' => 'Gagal Mengirim Saran']);
        }
    }
}
