<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SaranController extends Controller
{
    public function index()
    {
        $data = DB::table('saran')->join('member', 'saran.id_member','member.id_member')->get();
        return view('pages.saran.index',compact('data'));
    }

    public function remove($id)
    {
        $data = DB::table('saran')
        ->where('id_saran', $id)
        ->delete();
        if($data == TRUE)
        {
            return back()->with('success','Saran Berhasil Dihapus');
        } else {
            return back()->with('error','Gagal Menghapus Saran');
        }
    }
}
