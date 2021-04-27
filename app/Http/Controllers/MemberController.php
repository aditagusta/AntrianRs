<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\Member;
use DB;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'username' => 'required',
            'password' => 'required',
            'password1' => 'required',
            'nama_member' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'pangkat' => 'required',
            'satuan_kerja' => 'required',
            'lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'bpjs' => 'required',
            'pasien' => 'required',
        );
    }

    public function index()
    {
        $data = DB::table('member')->get();
        return view('pages.member.index', compact('data'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return back()->with('error','Cek Kembali Inputan Anda');
        } else {
            if ($request->password == $request->password1) {
                $pass = password_hash($request->password, PASSWORD_DEFAULT);
                $data = DB::table('member')->insert([
                    'username' => $request->username,
                    'password' => $pass,
                    'password1' => $request->password1,
                    'nama_member' => $request->nama_member,
                    'pangkat' => $request->pangkat,
                    'satuan_kerja' => $request->satuan_kerja,
                    'lahir' => $request->lahir,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'bpjs' => $request->bpjs,
                    'pasien' => $request->pasien,
                ]);
                return back()->with('success','Berhasil Menambahkan Member');
            } else {
                return back()->with('error','Gagal Menambahkan Member');
            }
        }
    }

    public function remove(Request $request,$id)
    {
        try {
            $data = Member::findOrFail($id);
            $data->delete();
            return back()->with('success','Data Berhasil Dihapus');
        } catch (ModelNotFoundException $e) {
            return back()->with('error','Gagal Menghapus Data');
        }
    }

    public function get(Request $request, $id)
    {
        $data = DB::table('member')->where('id_member', $id)->first();
        return view('pages.member.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id_member;
            $edit = Member::findOrFail($id);
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return back()->with('error','Cek Inputan Anda');
            } else {
                if ($request->password == $request->password1) {
                    $pass = password_hash($request->password, PASSWORD_DEFAULT);
                    $edit->username = $request->username;
                    $edit->password = $pass;
                    $edit->password1 = $request->password1;
                    $edit->nama_member = $request->nama_member;
                    $edit->pangkat = $request->pangkat;
                    $edit->satuan_kerja = $request->satuan_kerja;
                    $edit->lahir = $request->lahir;
                    $edit->alamat = $request->alamat;
                    $edit->jenis_kelamin = $request->jenis_kelamin;
                    $edit->bpjs = $request->bpjs;
                    $edit->pasien = $request->pasien;
                    $edit->save();
                    return redirect()->route('datamember')->with('success','Berhasil Ubah Data');
                } else {
                    return back()->with('error','Pastikan Password Harus Sama');
                }
            }
    }

    //
    public function registerMember(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
        } else {
            if ($request->password == $request->password1) {
                $pass = password_hash($request->password, PASSWORD_DEFAULT);
                $data = DB::table('member')->insert([
                    'username' => $request->username,
                    'password' => $pass,
                    'password1' => $request->password1,
                    'nama_member' => $request->nama_member,
                    'pangkat' => $request->pangkat,
                    'satuan_kerja' => $request->satuan_kerja,
                    'lahir' => $request->lahir,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'bpjs' => $request->bpjs,
                    'pasien' => $request->pasien,
                ]);
                return response()->json(['message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
            } else {
                return response()->json(['message' => 'Password Tidak Valid', 'status' => 200]);
            }
        }
    }


}
