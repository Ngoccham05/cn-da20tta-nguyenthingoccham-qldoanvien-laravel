<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\nganh;
use App\Models\chucvu;
use App\Models\loaicd;
use App\Models\loaidv;
use App\Models\chidoan;
use App\Models\dotdg;
use App\Models\doanvien;
use App\Models\tkadmin;
use App\Models\tkdoanvien;
use App\Models\hoatdong;
use App\Models\thamgia;
use App\Models\danhgiacd;
use App\Models\danhgiadv;
use App\Models\bieumau;
use App\Models\tieuchi;
use App\Models\dattc;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        $slchidoan = Chidoan::count();
        $sldoanvien = doanvien::count();
        $slhoatdong = hoatdong::count();

        $slgnam = DoanVien::where('gioitinh', 'Nam')->count();
        $slgnu = DoanVien::where('gioitinh', 'Nữ')->count();

        $loaidv = DB::table('danhgiadv')
            ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
            ->join('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
            ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
            ->select('dotdg.tendot', 'loaidv.tenloaidv', DB::raw('COUNT(*) as soLuong'))
            ->where('dotdg.trangthai', '=', 'Khóa')
            ->orderBy('loaidv.id')
            ->groupBy('dotdg.tendot', 'loaidv.tenloaidv')
            ->get();

        $chidoan = Chidoan::all();
        return view('admin.index', compact(['slchidoan', 'sldoanvien', 'slhoatdong', 'slgnam', 'slgnu', 'loaidv', 'chidoan']));
    }
    public function bdloc(Request $request)
    {
        try {
            $macd = $request->input('macd');

            $loaidv = DB::table('danhgiadv')
                ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
                ->join('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
                ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
                ->select('dotdg.tendot', 'loaidv.tenloaidv', DB::raw('COUNT(*) as soLuong'))
                ->where('dotdg.trangthai', '=', 'Khóa')
                ->where('doanvien.macd', $macd)
                ->orderBy('loaidv.id')
                ->groupBy('dotdg.tendot', 'loaidv.tenloaidv')
                ->get()
                ->toArray();
                
            return response()->json(['loaidv' => $loaidv]);
        } catch (\Exception $e) {            
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    // public function bdloc(Request $request)
    // {
        
    //     $macd = $request->input('macd');
    //     dd($macd);

    //     $loaidv = DB::table('danhgiadv')
    //         ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
    //         ->join('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
    //         ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
    //         ->select('dotdg.tendot', 'loaidv.tenloaidv', DB::raw('COUNT(*) as soLuong'))
    //         ->where('dotdg.trangthai', '=', 'Khóa')
    //         ->where('doanvien.macd', $macd)
    //         ->orderBy('loaidv.id')
    //         ->groupBy('dotdg.tendot', 'loaidv.tenloaidv')
    //         ->get();
            
    //     return response()->json(['loaidv' => $loaidv]);
    // }

//----------------tiêu chí----------------
    //ds tiêu chí
    public function tieuchi(Request $request)
    {
        $tieuchi = tieuchi::all();

        return view('admin.tieuchi', compact('tieuchi'));
    }

    public function themtc(Request $request)
    {
        $ten = $request->input('txtten');
        $count = tieuchi::where('tentc', $ten)->count();

        if($count > 0){
            return redirect('/admin/tieuchi')->with('error', $tennganh . ' đã tồn tại');
        }
        else{
            $tc = new tieuchi();
            $tc->tentc = $ten;
            $tc->save();

            return redirect('/admin/tieuchi')->with('success', 'Thêm thành công');
        }
    }
    // sửa tiêu chí
    public function suatc(Request $request)
    {
        $id = $request->input('txtma-sua');
        $ten = $request->input('txtten-sua');

        $tc = tieuchi::find($id);

        $count = tieuchi::where('tentc', $ten)-> where('id', '!=', $id) ->count();

        if($count > 0){
            return redirect('/admin/tieuchi')->with('error', $ten . ' đã tồn tại');
        }
        else{
            $tc->tentc = $ten;
            $tc->save();

            return redirect('/admin/tieuchi')->with('success', 'Cập nhật thành công');
        }
    }
    //xóa tiêu chí
    public function xoatc(Request $request)
    {
        $id = $request->input('txtma-xoa');
        DB::table('tieuchi')->where('id', $id)->delete();

        return redirect('/admin/tieuchi')->with('success', 'Xóa thành công');
    }

//----------------Chuyên ngành----------------
    //ds chuyên ngành
    public function chuyennganh(Request $request)
    {
        $chuyennganh = nganh::all();

        return view('admin.nganh', compact('chuyennganh'));
    }
    // thêm ngành
    public function themnganh(Request $request)
    {
        $tennganh = $request->input('txttennganh');
        $count = nganh::where('tennganh', $tennganh)->count();

        if($count > 0){
            return redirect('/admin/chuyennganh')->with('error', 'Ngành "' . $tennganh . '" đã tồn tại');
        }
        else{
            $nganh = new nganh();
            $nganh->tennganh = $tennganh;
            $nganh->save();

            return redirect('/admin/chuyennganh')->with('success', 'Thêm thành công');
        }
    }
    // sửa ngành
    public function suanganh(Request $request)
    {
        $id = $request->input('txtma');
        $tennganh = $request->input('txtten');

        $nganh = nganh::find($id);

        $count = nganh::where('tennganh', $tennganh)-> where('id', '!=', $id) ->count();

        if($count > 0){
            return redirect('/admin/chuyennganh')->with('error', 'Ngành "' . $tennganh . '" đã tồn tại');
        }
        else{
            $nganh->tennganh = $tennganh;
            $nganh->save();

            return redirect('/admin/chuyennganh')->with('success', 'Cập nhật thành công');
        }
    }
    //xóa ngành
    public function xoanganh(Request $request)
    {
        $id = $request->input('txtxoama');
        $nganh = nganh::find($id);
        $nganh->delete();

        return redirect('/admin/chuyennganh')->with('success', 'Xóa thành công');
    }

//----------------Chức vụ----------------
    // ds chức vụ
    public function chucvu()
    {
        $chucvu = chucvu::all();

        return view('admin.chucvu', compact('chucvu'));
    }
    // thêm chức vụ
    public function themchucvu(Request $request)
    {
        $tencv = $request->input('txttencv');
        $count = chucvu::where('tencv', $tencv)->count();

        if($count > 0){
            return redirect('/admin/chucvu')->with('error', '"' .$tencv . '" đã tồn tại');
        }
        else{
            $chucvu = new chucvu();
            $chucvu->tencv = $tencv;
            $chucvu->save();

            return redirect('/admin/chucvu')->with('success', 'Thêm thành công');
        }
    }
    // Sửa chức vụ
    public function suachucvu(Request $request)
    {
        $id = $request->input('txtmacv-sua');
        $tencv = $request->input('txttencv-sua');

        $cv = chucvu::find($id);

        $count = chucvu::where('tencv', $tencv)-> where('id', '!=', $id) ->count();

        if($count > 0){
            return redirect('/admin/chucvu')->with('error', '"' . $tencv . '" đã tồn tại');
        }
        else{
            $cv->tencv = $tencv;
            $cv->save();

            return redirect('/admin/chucvu')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa chức vụ
    public function xoachucvu(Request $request)
    {
        $id = $request->input('txtmacv-xoa');
        $cv = chucvu::find($id);
        $cv->delete();

        return redirect('/admin/chucvu')->with('success', 'Xóa thành công');
    }

//----------------Loại chi đoàn----------------
    // ds loại chi đoàn
    public function loaicd()
    {
        $loaicd = loaicd::all();

        return view('admin.loaicd', compact('loaicd'));
    }
    // thêm loại chi đoàn
    public function themloaicd(Request $request)
    {
        $tenloaicd = $request->input('txttenloaicd');
        $count = loaicd::where('tenloaicd', $tenloaicd)->count();

        if($count > 0){
            return redirect('/admin/loaicd')->with('error', 'Loại "' .$tenloaicd . '" đã tồn tại');
        }
        else{
            $loaicd = new loaicd();
            $loaicd->tenloaicd = $tenloaicd;
            $loaicd->save();

            return redirect('/admin/loaicd')->with('success', 'Thêm thành công');
        }
    }
    // sửa loại chi đoàn
    public function sualoaicd(Request $request)
    {
        $id = $request->input('txtmaloaicd-sua');
        $tenloaicd = $request->input('txttenloaicd-sua');

        $loaicd = loaicd::find($id);

        $count = loaicd::where('tenloaicd', $tenloaicd)-> where('id', '!=', $id) ->count();

        if($count > 0){
            return redirect('/admin/loaicd')->with('error', 'Loại "' . $tenloaicd . '" đã tồn tại');
        }
        else{
            $loaicd->tenloaicd = $tenloaicd;
            $loaicd->save();

            return redirect('/admin/loaicd')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa loại chi đoàn
    public function xoaloaicd(Request $request)
    {
        $id = $request->input('txtmaloaicd-xoa');
        DB::table('loaicd')->where('id', $id)->delete();

        return redirect('/admin/loaicd')->with('success', 'Xóa thành công');
    }

//----------------Loại đoàn viên----------------
    // ds loại đoàn viên
    public function loaidv()
    {
        $loaidv = loaidv::all();

        return view('admin.loaidv', compact('loaidv'));
    }
    // thêm loại đoàn viên
    public function themloaidv(Request $request)
    {
        $tenloaidv = $request->input('txttenloaidv');
        $count = loaidv::where('tenloaidv', $tenloaidv)->count();

        if($count > 0){
            return redirect('/admin/loaidv')->with('error', 'Loại "' .$tenloaidv . '" đã tồn tại');
        }
        else{
            $loaidv = new loaidv();
            $loaidv->tenloaidv = $tenloaidv;
            $loaidv->save();

            return redirect('/admin/loaidv')->with('success', 'Thêm thành công');
        }
    }
    // sửa loại đoàn viên
    public function sualoaidv(Request $request)
    {
        $id = $request->input('txtmaloaidv-sua');
        $tenloaidv = $request->input('txttenloaidv-sua');

        $loaidv = loaidv::find($id);

        $count = loaidv::where('tenloaidv', $tenloaidv)-> where('id', '!=', $id) ->count();

        if($count > 0){
            return redirect('/admin/loaidv')->with('error', 'Loại "' . $tenloaidv . '" đã tồn tại');
        }
        else{
            $loaidv->tenloaidv = $tenloaidv;
            $loaidv->save();

            return redirect('/admin/loaidv')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa loại đoàn viên
    public function xoaloaidv(Request $request)
    {
        $id = $request->input('txtmaloaidv-xoa');
        $loaidv = loaidv::find($id);
        $loaidv->delete();

        return redirect('/admin/loaidv')->with('success', 'Xóa thành công');
    }

//----------------Chi đoàn----------------
    // ds chi đoàn
    public function chidoan()
    {
        $nganh = nganh::all();
        $chidoan = chidoan::with('nganh')->get();

        return view('admin.chidoan', compact(['nganh', 'chidoan']));
    }
    // thêm chi đoàn
    public function themcd(Request $request)
    {
        $macd = $request->input('txtmacd');
        $tencd = $request->input('txttencd');
        $nganh = $request-> input('slnganh');

        $count_ma = chidoan::where('macd', $macd)->count();
        $count_ten = chidoan::where('tencd', $tencd)->count();

        if($count_ma > 0 || $count_ten > 0){
            return redirect('/admin/chidoan')->with('error', 'Mã hoặc tên chi đoàn đã tồn tại');
        }
        else{
            $cd = new chidoan();
            $cd->macd = $macd;
            $cd->tencd = $tencd;
            $cd->manganh = $nganh;
            $cd->save();

            return redirect('/admin/chidoan')->with('success', 'Thêm thành công');
        }
    }
    //sửa chi đoàn
    public function suacd(Request $request)
    {
        $macd = $request->input('txtmacd-sua');
        $tencd = $request->input('txttencd-sua');
        $manganh = $request-> input('slnganh-sua');

        //$cd = chidoan::where('macd', $macd)->first();

        $count_ten = chidoan::where('tencd', $tencd)-> where('macd', '!=', $macd) ->count();

        if($count_ten > 0){
            return redirect('/admin/chidoan')->with('error', 'Tên chi đoàn "' . $tencd . '" đã tồn tại');
        }
        else{
            DB::table('chidoan')
                ->where('macd', $macd)
                ->update(['tencd' => $tencd, 'manganh'=>$manganh]);

            return redirect('/admin/chidoan')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa chi đoàn
    public function xoacd(Request $request)
    {
        $macd = $request->input('txtmacd-xoa');
        //$cd = chidoan::where('macd', $macd)->first();
        DB::table('chidoan')->where('macd', $macd)->delete();

        return redirect('/admin/chidoan')->with('success', 'Xóa thành công');
    }

//----------------Đợt đánh giá----------------
    
    public function dotdg()
    {
        $dotdg = dotdg::all();
     
        return view('admin.dotdg', compact('dotdg'));
    }
    // thêm đợt
    public function themdot(Request $request)
    {
        $madot = $request->input('txtmadot');
        $tendot = $request->input('txttendot');
        $batdau = $request-> input('txtbd');
        $ketthuc = $request->input('txtkt');
        $trangthai = $request-> input('sltrangthai');

        $count_ma = dotdg::where('madot', $madot)->count();
        $count_ten = dotdg::where('tendot', $tendot)->count();

        if($count_ma > 0 || $count_ten > 0){
            return redirect('/admin/dotdg')->with('error', 'Mã hoặc tên đợt đánh giá đã tồn tại');
        }
        else{
            $dotdg = new dotdg();
            $dotdg->madot = $madot;
            $dotdg->tendot = $tendot;
            $dotdg->tgbatdau = $batdau;
            $dotdg->tgketthuc = $ketthuc;
            $dotdg->trangthai = $trangthai;

            $dotdg->save();

            return redirect('/admin/dotdg')->with('success', 'Thêm thành công');
        }
    }
    // sửa đợt
    public function suadot(Request $request)
    {
        $madot = $request->input('txtmadot-sua');
        $tendot = $request->input('txttendot-sua');
        $batdau = $request-> input('txtbd-sua');
        $ketthuc = $request->input('txtkt-sua');
        $trangthai = $request-> input('sltrangthai-sua');

        $count_ten = dotdg::where('tendot', $tendot)-> where('madot', '!=', $madot) ->count();

        if($count_ten > 0){
            return redirect('/admin/dotdg')->with('error', 'Tên đợt "' . $tendot . '" đã tồn tại');
        }
        else{
            DB::table('dotdg')
                ->where('madot', $madot)
                ->update(['tendot' => $tendot, 'tgbatdau'=>$batdau, 'tgketthuc'=>$ketthuc, 'trangthai'=>$trangthai]);

            return redirect('/admin/dotdg')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa đợt
    public function xoadot(Request $request)
    {
        $madot = $request->input('txtmadot-xoa');
        DB::table('dotdg')->where('madot', $madot)->delete();

        return redirect('/admin/dotdg')->with('success', 'Xóa thành công');
    }

//----------------đoàn viên----------------

    public function doanvien()
    {
        $chidoan = chidoan::all();
        $chucvu = chucvu::all();
        $doanvien = doanvien::with(['chidoan', 'chucvu'])->orderBy('macd')->get();

        return view('admin.doanvien', compact(['doanvien', 'chucvu', 'chidoan']));
    }
    // thêm đoàn viên
    public function themdv(Request $request)
    {
        $madv = $request->input('txtma');
        $ten = $request->input('txtten');
        $gioi = $request-> input('slgioi');
        $ns = $request->input('txtngaysinh');
        $sdt = $request-> input('txtsdt');
        $dc = $request->input('txtdiachi');
        $ngayvd = $request->input('txtngayvd');
        $noivd = $request-> input('txtnoivd');
        $macd = $request->input('slchidoan');
        $macv = $request-> input('slchucvu');

        $chucvu = DB::table('chucvu')->where('id', $macv)->value('tencv');
        if(stripos($chucvu, 'Đoàn khoa') !== false){
            $role = "1";
        }
        else if(stripos($chucvu, 'Chi đoàn') !== false){
            $role = "2";  
        }
        else{
            $role = "3"; 
        }

        $count_ma = doanvien::where('madv', $madv)->count();
        if($count_ma > 0){
            return redirect('/admin/doanvien')->with('error', 'Mã đoàn viên tồn tại');
        }
        else{
            $dv = new doanvien();
            $dv->madv = $madv;
            $dv->hoten = $ten;
            $dv->gioitinh = $gioi;
            $dv->ngaysinh = $ns;
            $dv->sdt = $sdt;
            $dv->diachi = $dc;
            $dv->ngayvaodoan = $ngayvd;
            $dv->noivaodoan = $noivd;
            $dv->macd = $macd;
            $dv->macv = $macv;
            $dv->save();

            $tk = new tkdoanvien();
            $tk->username = $madv;
            $tk->password = md5(123456);
            $tk->active = "1";
            $tk->role = $role;
            $tk->save();

            return redirect('/admin/doanvien')->with('success', 'Thêm thành công');
        }
    }
    // sửa đoàn viên
    public function suadv(Request $request)
    {
        $madv = $request->input('txtma-sua');
        $ten = $request->input('txtten-sua');
        $gioi = $request-> input('slgioi-sua');       
        $ns = $request->input('txtngaysinh-sua');
        $sdt = $request-> input('txtsdt-sua');
        $dc = $request->input('txtdiachi-sua');
        $ngayvd = $request->input('txtngayvd-sua');
        $noivd = $request-> input('txtnoivd-sua');
        $macd = $request->input('slchidoan-sua');
        $macv = $request-> input('slchucvu-sua');

        $chucvu = DB::table('chucvu')->where('id', $macv)->value('tencv');
        if(stripos($chucvu, 'Đoàn khoa') !== false){
            $role = "1";
        }
        else if(stripos($chucvu, 'Chi đoàn') !== false){
            $role = "2";  
        }
        else{
            $role = "3"; 
        }

        DB::table('doanvien')
            ->where('madv', $madv)
            ->update([
                'hoten' => $ten,
                'gioitinh' => $gioi,
                'ngaysinh' => $ns,
                'sdt' => $sdt,
                'diachi' => $dc,
                'ngayvaodoan' => $ngayvd,
                'noivaodoan' => $noivd,
                'macd' => $macd,
                'macv' => $macv,
            ]);

        DB::table('tkdoanvien')
            ->where('username', $madv)
            ->update([
                'role' => $role,
            ]);


        return redirect('/admin/doanvien')->with('success', 'Cập nhật thành công');
    }
    // xóa đoàn viên
    public function xoadv(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('doanvien')->where('madv', $ma)->delete();

        return redirect('/admin/doanvien')->with('success', 'Xóa thành công');
    }
//---------------- Tài khoản ----------------

    public function taikhoan()
    {
        $tkdoanvien = tkdoanvien::all();

        return view('admin.taikhoan', compact('tkdoanvien'));
    }
    
    public function resetpass(Request $request)
    {
        $username = $request->input('txtusername-reset');
        $pwd = md5(123456);

        DB::table('tkdoanvien')
            ->where('username', $username)
            ->update([
                'password' => $pwd
            ]);

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function doitt(Request $request, $username)
    {
        $tk = tkdoanvien::where('username', $username)->first();

        $newactive = $tk->active == '1' ? '0' : '1';

        DB::table('tkdoanvien')
            ->where('username', $username)
            ->update([
                'active' => $newactive
            ]);

        return redirect('/admin/taikhoan')->with('success', 'Cập nhật thành công');
    }

//---------------- Biểu mẫu ----------------
    //ds biểu mẫu
    public function bieumau()
    {
        $bieumau = bieumau::all();
        return view('admin.bieumau', compact('bieumau'));
    }
    // Thêm biểu mẫu
    public function thembm(Request $request)
    {
        $tenbm = $request->input('txtten');
        $filepath = '';

        if ($request->hasFile('filemc')) {
            $fileUpload = $request->file('filemc');
            $extension = $fileUpload->getClientOriginalExtension();

            // if ($extension == 'pdf') {
                $filename = $tenbm . '.' . $extension;

                $filepath = $fileUpload->storeAs('bieumau', $filename, 'public');    
            // }
        }

        $bm = new bieumau();
        $bm->tenbm = $tenbm;
        $bm->duongdan = $filepath;
        $bm->save();

        return redirect('/admin/bieumau')->with('success', 'Thêm thành công');
    }
    // Sửa biểu mẫu
    public function suabm(Request $request)
    {
        $ma = $request->input('txtma-sua');
        $ten = $request->input('txtten-sua');
        $filepath = '';

        if ($request->hasFile('filemc-sua')) {
            $fileUpload = $request->file('filemc-sua');
            $extension = $fileUpload->getClientOriginalExtension();

            // if ($extension == 'pdf') {
                $filename = $ten . '.' . $extension;
                $filepath = $fileUpload->storeAs('bieumau', $filename, 'public');
            // }

            DB::table('bieumau')
                ->where('id', $ma)
                ->update([
                    'tenbm' => $ten,
                    'duongdan' => $filepath
                ]);
        }
        else{
            DB::table('bieumau')
                ->where('id', $ma)
                ->update([
                    'tenbm' => $ten,
                ]);
        }
        return redirect('/admin/bieumau')->with('success', 'Cập nhật thành công');
    }
    //xóa biểu mẫu
    public function xoabm(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('bieumau')->where('id', $ma)->delete();

        return redirect('/admin/bieumau')->with('success', 'Xóa thành công');
    }
//---------------- Hoạt động----------------
    //ds hoạt động
    public function hoatdong()
    {
        $hoatdong = hoatdong::orderByDesc('thoigian')->get();

        return view('admin.hoatdong', compact('hoatdong'));
    }
    
    // Thêm hoạt động
    public function themhoatdong(Request $request)
    {
        $tenhd = $request->input('txtten');
        $tg = $request->input('txttg');
        $dd = $request->input('txtdd');
        $mota = $request->input('txtmota');
        $filepath = '';

        if ($request->hasFile('filemc')) {
            $fileUpload = $request->file('filemc');

            $extension = $fileUpload->extension();

            if ($extension == 'pdf') {
                //$dateUpload = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                //$filename = $dateUpload . '_' . $fileUpload->getClientOriginalName();
                $filename = $tenhd . '_' . str_replace([':', ' '], '', $tg) . '.pdf';

                $filepath = $fileUpload->storeAs('hoatdong', $filename, 'public');
                
            }
        }

        $hd = new hoatdong();
        $hd->tenhd = $tenhd;
        $hd->thoigian = $tg;
        $hd->diadiem = $dd;
        $hd->mota = $mota;
        $hd->minhchung = $filepath;
        $hd->save();

        return redirect('/admin/hoatdong')->with('success', 'Thêm thành công');
    }
    //sửa hoạt động
    public function suahoatdong(Request $request)
    {
        $ma = $request->input('txtma-sua');
        $tenhd= $request->input('txtten-sua');
        $tg = $request->input('txttg-sua');
        $dd = $request-> input('txtdd-sua');       
        $mota = $request->input('txtmota-sua');
        $filepath = '';

        if ($request->hasFile('filemc-sua')) {
            $fileUpload = $request->file('filemc-sua');
            $extension = $fileUpload->extension();

            if ($extension == 'pdf') {
                // $dateUpload = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                // $filename = $dateUpload . '_' . $fileUpload->getClientOriginalName();
                $filename = $tenhd . '_' . str_replace([':', ' '], '', $tg) . '.pdf';

                $filepath = $fileUpload->storeAs('hoatdong', $filename, 'public');
            }

            DB::table('hoatdong')
                ->where('id', $ma)
                ->update([
                    'tenhd' => $tenhd,
                    'thoigian' => $tg,
                    'diadiem' => $dd,
                    'mota' => $mota,
                    'minhchung' => $filepath
                ]);
        }
        else{
            DB::table('hoatdong')
                ->where('id', $ma)
                ->update([
                    'tenhd' => $tenhd,
                    'thoigian' => $tg,
                    'diadiem' => $dd,
                    'mota' => $mota,
                ]);
        }
        return redirect('/admin/hoatdong')->with('success', 'Cập nhật thành công');
    }
    //xóa hoạt động
    public function xoahoatdong(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('hoatdong')->where('id', $ma)->delete();

        return redirect('/admin/hoatdong')->with('success', 'Xóa thành công');
    }

//---------------- tham gia hoạt động ----------------
    // ds tham gia theo mã hoạt động
    public function thamgia(Request $request)
    {
        $mahd = $request->get('hd');
        $hoatdong = DB::table('hoatdong')->where('id', $mahd)->get();
        $thamgia = DB::table('thamgia')
                        ->join('doanvien', 'thamgia.madv', '=', 'doanvien.madv')
                        ->join('hoatdong', 'thamgia.mahd', '=', 'hoatdong.id')
                        ->where('thamgia.mahd', $mahd)
                        ->orderBy('macd')
                        ->get();

        $doanvien = DB::table('doanvien')
                        ->whereNotIn('madv', function ($query) use ($mahd) {
                            $query->select('madv')
                                ->from('thamgia')
                                ->where('mahd', $mahd);
                        })
                        ->orderBy('macd')
                        ->get();
        return view('admin.thamgia', compact(['hoatdong', 'thamgia', 'doanvien']));
    }
    //thêm đoàn viên tham gia
    public function themdvtg(Request $request)
    {
        $mahd = $request->input('txtmahd');
        $madv = $request->input('sldoanvien');

        $tg = new thamgia();
        $tg->mahd = $mahd;
        $tg->madv = $madv;
        $tg->save();
        
        return redirect('/admin/thamgia?hd='.$mahd)->with('success', 'Thêm thành công');
    }
    //xóa đoàn viên tham gia
    public function xoadvtg(Request $request)
    {
        $mahd = $request->input('txtmahd-xoa');
        $madv = $request->input('txtmadv-xoa');

        DB::table('thamgia')->where('mahd', $mahd)->where('madv', $madv)->delete();
        
        return redirect('/admin/thamgia?hd='.$mahd)->with('success', 'Xóa thành công');
    }

//---------------- xếp loại chi đoàn ----------------
    //ds xếp loại chi đoàn
    public function danhgiacd()
    {
        $chidoan = chidoan::all();
        $dotdg = dotdg::where('trangthai', 'Khóa')->get();
        $loaicd = loaicd::all();
        //$danhgia = danhgiacd::with(['chidoan', 'dotdg', 'loaicd'])->orderBy('madot')->get();
        $danhgia = danhgiacd::join('chidoan', 'chidoan.macd', '=', 'danhgiacd.macd')
                ->join('dotdg', 'dotdg.madot', '=', 'danhgiacd.madot')
                ->join('loaicd', 'loaicd.id', '=', 'danhgiacd.maloaicd')
                ->orderBy('danhgiacd.madot')
                ->get();

        return view('admin.danhgiacd', compact(['danhgia', 'dotdg', 'chidoan', 'loaicd']));
    }

    // thêm xếp loại cd
    public function themdgcd(Request $request)
    {
        $dot = $request->input('sldotdg');
        $chidoan = $request->input('slchidoan');
        $loai = $request->input('slloai');

        $count = DB::table('danhgiacd')->where('madot', $dot)->where('macd', $chidoan)->count();

        if($count > 0){
            return redirect('/admin/danhgiacd')->with('error', 'Chi đoàn đã đánh giá');
        }
        else{
            $dg = new danhgiacd();
            $dg->macd = $chidoan;
            $dg->maloaicd = $loai;
            $dg->madot = $dot;
            $dg->save();
    
            return redirect('/admin/danhgiacd')->with('success', 'Thêm thành công');
        }
    }

    // sửa xếp loại cd
    public function suadgcd(Request $request)
    {
        $dot = $request->input('txtdotdg-sua');
        $chidoan = $request->input('txtchidoan-sua');
        $loai = $request->input('slloai-sua');

        DB::table('danhgiacd')
            ->where('madot', $dot)->where('macd', $chidoan)
            ->update([
                'maloaicd' => $loai
            ]);
    
        return redirect('/admin/danhgiacd')->with('success', 'Cập nhật thành công');
    }
    // xóa xếp loại cd
    public function xoadgcd(Request $request)
    {
        $dot = $request->input('txtdotdg-xoa');
        $chidoan = $request->input('txtchidoan-xoa');

        DB::table('danhgiacd')->where('madot', $dot)->where('macd', $chidoan)->delete();

        return redirect('/admin/danhgiacd')->with('success', 'Xóa thành công');
    }
    
//---------------- xếp loại chi đoàn ----------------
    //ds xếp loại đoàn viên
    public function danhgiadv()
    {
        $doanvien = doanvien::all();
        $dotdg = dotdg::where('trangthai', 'Khóa')->get();
        $loaidv = loaidv::all();
        $danhgia = danhgiadv::with(['doanvien', 'dotdg', 'loaidv'])->orderBy('madot')->get();

        return view('admin.danhgiadv', compact(['danhgia', 'dotdg', 'doanvien', 'loaidv']));
    }
    // thêm xếp loại dv
    public function themdgdv(Request $request)
    {
        $dot = $request->input('sldotdg');
        $dv = $request->input('sldoanvien');
        $loai = $request->input('slloai');

        $count = DB::table('danhgiadv')->where('madot', $dot)->where('madv', $dv)->count();

        if($count > 0){
            return redirect('/admin/danhgiadv')->with('error', 'Đoàn viên đã đánh giá');
        }
        else{
            $dg = new danhgiadv();
            $dg->madv = $dv;
            $dg->maloaidv = $loai;
            $dg->madot = $dot;
            $dg->save();
    
            return redirect('/admin/danhgiadv')->with('success', 'Thêm thành công');
        }
    }
    // sửa xếp loại dv
    public function suadgdv(Request $request)
    {
        $dot = $request->input('txtdotdg-sua');
        $dv = $request->input('txtdoanvien-sua');
        $loai = $request->input('slloai-sua');

        DB::table('danhgiadv')
            ->where('madot', $dot)->where('madv', $dv)
            ->update([
                'maloaidv' => $loai
            ]);
    
        return redirect('/admin/danhgiadv')->with('success', 'Cập nhật thành công');
    }
    // xóa xếp loại dv
    public function xoadgdv(Request $request)
    {
        $dot = $request->input('txtdotdg-xoa');
        $dv = $request->input('txtdoanvien-xoa');

        DB::table('danhgiadv')->where('madot', $dot)->where('madv', $dv)->delete();

        return redirect('/admin/danhgiadv')->with('success', 'Xóa thành công');
    }

}