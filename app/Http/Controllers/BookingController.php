<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\Booking;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_member' => 'required',
            'pelayanan' => 'required',
            'tanggal_booking' => 'required',
        );
    }

    public function index()
    {
        $data = DB::table('booking')->join('member','booking.id_member','member.id_member')->get();
        // $init = array();
        // $today = date('Y-m-d');
        // foreach ($data as $key => $a) {
        //     if($a->tanggal_booking > $today)
        //     {
        //         $init = array([
        //             'id_booking' => $a->id_booking,
        //             'nama_member' => $a->nama_member,
        //             'pelayanan' => $a->pelayanan,
        //             'tanggal_booking' => $a->tanggal_booking,
        //             'no_antrian' => $a->no_antrian,
        //             'status' => $set
        //             ]);
        //     } else {
        //         $set = $a->status = 1;
        //         $init = array([
        //             'id_booking' => $a->id_booking,
        //             'nama_member' => $a->nama_member,
        //             'pelayanan' => $a->pelayanan,
        //             'tanggal_booking' => $a->tanggal_booking,
        //             'no_antrian' => $a->no_antrian,
        //             'status' => $set
        //             ]);
        //     }
        // }
        return view('pages.booking.index',compact('data'));
    }

    public function export()
    {
        $data = DB::table('booking')->join('member','booking.id_member','member.id_member')->get();
        return view('pages.booking.export',compact('data'));
    }

    public function remove($id)
    {
        $data = DB::table('booking')
        ->where('id_booking', $id)
        ->delete();
        if($data == TRUE)
        {
            return back()->with('success','Data Booking Berhasil Dihapus');
        } else {
            return back()->with('error','Gagal Menghapus Data Booking');
        }
    }

    public function dataBooking()
    {
        $id = Auth::guard('member')->user()->id_member;
        $data = DB::table('booking')->where('id_member',$id)->get();
        if($data == TRUE)
        {
            return response()->json(['status'=>200,'message'=>'Data Ditemukan', 'data'=>$data]);
        }else{
            return response()->json(['status'=>404,'message'=>'Data Tidak Ditemukan']);
        }
    }

    public function antrian(Request $request)
    {
        $no = $request->tanggal_booking;
        $antrian = DB::table('booking')->where('tanggal_booking',$no)->orderBy('no_antrian', 'desc')->first();
        if ($antrian == NULL) {
            $nomor = 1;
        } else {
            $cekantrian = $antrian->no_antrian;
            $plus = (int)$cekantrian + 1;
            $nomor = $plus;
        }
        return response()->json(['nomor' => $nomor,'status' => 200]);
    }

    public function registerBooking(Request $request)
    {
        $id_member = Auth::guard('member')->user()->id_member;
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
        } else {
                $data = DB::table('booking')->insert([
                    'no_antrian' => $request->no_antrian,
                    'id_member' => $id_member,
                    'pelayanan' => $request->pelayanan,
                    'tanggal_booking' => $request->tanggal_booking,
                ]);
                return response()->json(['message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
        }
    }
}
