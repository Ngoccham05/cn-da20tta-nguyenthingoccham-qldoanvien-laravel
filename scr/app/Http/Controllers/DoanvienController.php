<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

class DoanvienController extends Controller
{
    //trang chủ
    public function trangchu()
    {
        return view('doanvien.index');
    }
    //trang thông tin cá nhân
    public function ttcanhan()
    {
        $madv = Auth::guard('doanvien')->user()->username;
        $chidoan = chidoan::all();
        $chucvu = chucvu::all();
        $thongtin = doanvien::with(['chidoan', 'chucvu'])->where('madv', $madv)->first();

        return view('doanvien.ttcanhan', compact(['thongtin', 'chidoan', 'chucvu']));
    }

    public function bieumau()
    {
        $bieumau = bieumau::all();
        return view('doanvien.bieumau', compact('bieumau'));
    }
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

        return redirect('/ktcn/bieumau')->with('success', 'Thêm thành công');
    }
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
        return redirect('/ktcn/bieumau')->with('success', 'Cập nhật thành công');
    }
    //xóa biểu mẫu
    public function xoabm(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('bieumau')->where('id', $ma)->delete();

        return redirect('/ktcn/bieumau')->with('success', 'Xóa thành công');
    }

    //Sửa thông tin cá nhân
    public function suatt(Request $request)
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
                // 'macv' => $macv,
            ]);

        return redirect('/ktcn/ttcanhan')->with('success', 'Cập nhật thành công');
    }

    //đổi mật khẩu tài khoản
    public function doimk(Request $request)
    {
        $user = Auth::guard('doanvien')->user();
        $oldpwd = $request->input('txtoldpwd');
        $newpwd = $request->input('txtnewpwd');
        $renewpwd = $request->input('txtrenewpwd');

        DB::table('tkdoanvien')
        ->where('username', $user->username)
        ->update([
            'password' => md5($newpwd)
        ]);

        return redirect('/ktcn/ttcanhan')->with('success', 'Cập nhật thành công');
    }

    //ds tất cả hoạt động
    public function hoatdong()
    {
        $user = Auth::guard('doanvien')->user();
        $hoatdong = hoatdong::all();
        $hdthamgia = hoatdong::join('thamgia', 'hoatdong.id', '=', 'thamgia.mahd')
                    ->where('thamgia.madv', $user->username)
                    ->get();

        return view('doanvien.hoatdong', compact(['hoatdong', 'hdthamgia']));
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

        return redirect('/ktcn/hoatdong')->with('success', 'Thêm thành công');
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
        return redirect('/ktcn/hoatdong')->with('success', 'Cập nhật thành công');
    }
    //xóa hoạt động
    public function xoahoatdong(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('hoatdong')->where('id', $ma)->delete();

        return redirect('/ktcn/hoatdong')->with('success', 'Xóa thành công');
    }

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
        return view('doanvien.thamgia', compact(['hoatdong', 'thamgia', 'doanvien']));
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
        
        return redirect('/ktcn/thamgia?hd='.$mahd)->with('success', 'Thêm thành công');
    }
    //xóa đoàn viên tham gia
    public function xoadvtg(Request $request)
    {
        $mahd = $request->input('txtmahd-xoa');
        $madv = $request->input('txtmadv-xoa');

        DB::table('thamgia')->where('mahd', $mahd)->where('madv', $madv)->delete();
        
        return redirect('/ktcn/thamgia?hd='.$mahd)->with('success', 'Xóa thành công');
    }

    //ds chi đoàn
    public function chidoan()
    {
        $nganh = nganh::all();
        $dschidoan = Chidoan::with('nganh')->get();
        $chidoan = [];

        foreach ($dschidoan as $cd) {
            $solg = Doanvien::where('macd', $cd->macd)->count();
            $chidoan[] = ['chidoan' => $cd, 'soluong' => $solg];
        }
        // dd($chidoan);

        return view('doanvien.chidoan', compact(['nganh', 'chidoan']));
    }
    //thêm chi đoàn
    public function themcd(Request $request)
    {
        $macd = $request->input('txtmacd');
        $tencd = $request->input('txttencd');
        $nganh = $request-> input('slnganh');

        $count_ma = chidoan::where('macd', $macd)->count();
        $count_ten = chidoan::where('tencd', $tencd)->count();

        if($count_ma > 0 || $count_ten > 0){
            return redirect('/ktcn/chidoan')->with('error', 'Mã hoặc tên chi đoàn đã tồn tại');
        }
        else{
            $cd = new chidoan();
            $cd->macd = $macd;
            $cd->tencd = $tencd;
            $cd->manganh = $nganh;
            $cd->save();

            return redirect('/ktcn/chidoan')->with('success', 'Thêm thành công');
        }
    }
    //sửa chi đoàn
    public function suacd(Request $request)
    {
        $macd = $request->input('txtmacd-sua');
        $tencd = $request->input('txttencd-sua');
        $manganh = $request-> input('slnganh-sua');

        $count_ten = chidoan::where('tencd', $tencd)-> where('macd', '!=', $macd) ->count();

        if($count_ten > 0){
            return redirect('/ktcn/chidoan')->with('error', 'Tên chi đoàn "' . $tencd . '" đã tồn tại');
        }
        else{
            DB::table('chidoan')
                ->where('macd', $macd)
                ->update(['tencd' => $tencd, 'manganh'=>$manganh]);

            return redirect('/ktcn/chidoan')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa chi đoàn
    public function xoacd(Request $request)
    {
        $macd = $request->input('txtmacd-xoa');
        DB::table('chidoan')->where('macd', $macd)->delete();

        return redirect('/ktcn/chidoan')->with('success', 'Xóa thành công');
    }
    //Danh sách đoàn viên theo chi đoàn
    public function dvchidoan(Request $request)
    {
        $macd = $request->get('macd');
        $chidoan = chidoan::all();
        $chucvu = Chucvu::all();
        $doanvien = doanvien::with(['chidoan', 'chucvu'])->where('macd', $macd)->orderBy('macd')->orderBy('madv')->get();
        return view('doanvien.doanvien', compact(['chidoan', 'chucvu', 'doanvien']));
    }

    //ds đoàn viên
    public function doanvien()
    {
        $user = Auth::guard('doanvien')->user();
        if($user->role == "1"){
            $chidoan = chidoan::all();
            $chucvu = chucvu::all();
            $doanvien = doanvien::with(['chidoan', 'chucvu'])->orderBy('macd')->get();
        }
        else{
            $macd = doanvien::where('madv', $user->username)->value('macd');
            $chidoan = chidoan::all();
            $chucvu = Chucvu::where('tencv', 'not like', '%Đoàn khoa%')->get();
            $doanvien = doanvien::with(['chidoan', 'chucvu'])->where('macd', $macd)->orderBy('macd')->orderBy('madv')->get();
        }

        return view('doanvien.doanvien', compact(['doanvien', 'chucvu', 'chidoan']));
    }
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
            return redirect('/ktcn/doanvien')->with('error', 'Mã đoàn viên tồn tại');
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
            $tk->password = "123456";
            $tk->active = "1";
            $tk->role = $role;
            $tk->save();

            return redirect('/ktcn/doanvien')->with('success', 'Thêm thành công');
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


        return redirect('/ktcn/doanvien')->with('success', 'Cập nhật thành công');
    }
    // xóa đoàn viên
    public function xoadv(Request $request)
    {
        $ma = $request->input('txtma-xoa');
        DB::table('doanvien')->where('madv', $ma)->delete();

        return redirect('/ktcn/doanvien')->with('success', 'Xóa thành công');
    }

    //ds đợt đánh giá
    public function dotdg()
    {
        $dotdg = Dotdg::orderByDesc('tgbatdau')->get();
     
        return view('doanvien.dotdg', compact('dotdg'));
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
            return redirect('/ktcn/dotdg')->with('error', 'Mã hoặc tên đợt đánh giá đã tồn tại');
        }
        else{
            $dotdg = new dotdg();
            $dotdg->madot = $madot;
            $dotdg->tendot = $tendot;
            $dotdg->tgbatdau = $batdau;
            $dotdg->tgketthuc = $ketthuc;
            $dotdg->trangthai = $trangthai;

            $dotdg->save();

            return redirect('/ktcn/dotdg')->with('success', 'Thêm thành công');
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
            return redirect('/ktcn/dotdg')->with('error', 'Tên đợt "' . $tendot . '" đã tồn tại');
        }
        else{
            DB::table('dotdg')
                ->where('madot', $madot)
                ->update(['tendot' => $tendot, 'tgbatdau'=>$batdau, 'tgketthuc'=>$ketthuc, 'trangthai'=>$trangthai]);

            return redirect('/ktcn/dotdg')->with('success', 'Cập nhật thành công');
        }
    }
    // xóa đợt
    public function xoadot(Request $request)
    {
        $madot = $request->input('txtmadot-xoa');
        DB::table('dotdg')->where('madot', $madot)->delete();

        return redirect('/ktcn/dotdg')->with('success', 'Xóa thành công');
    }

//----------------tiêu chí----------------
    //ds tiêu chí
    public function tieuchi(Request $request)
    {
        $tieuchi = tieuchi::all();
        $dotdg = dotdg::where('trangthai', '!=', 'Khóa')
                    ->where('tgbatdau', '<=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->where('tgketthuc', '>=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->first();
        return view('doanvien.tieuchi', compact('tieuchi', 'dotdg'));
    }

    public function themtc(Request $request)
    {
        $ten = $request->input('txtten');
        $count = tieuchi::where('tentc', $ten)->count();

        if($count > 0){
            return redirect('/ktcn/tieuchi')->with('error', $tennganh . ' đã tồn tại');
        }
        else{
            $tc = new tieuchi();
            $tc->tentc = $ten;
            $tc->save();

            return redirect('/ktcn/tieuchi')->with('success', 'Thêm thành công');
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
            return redirect('/ktcn/tieuchi')->with('error', $ten . ' đã tồn tại');
        }
        else{
            $tc->tentc = $ten;
            $tc->save();

            return redirect('/ktcn/tieuchi')->with('success', 'Cập nhật thành công');
        }
    }
    //xóa tiêu chí
    public function xoatc(Request $request)
    {
        $id = $request->input('txtma-xoa');
        DB::table('tieuchi')->where('id', $id)->delete();

        return redirect('/ktcn/tieuchi')->with('success', 'Xóa thành công');
    }

    // đoàn khoa đánh giá chi đoàn
    public function danhgiacd(Request $request)
    {
        $madv = Auth::guard('doanvien')->user()->username;
        $dotdg = dotdg::where('trangthai', '!=', 'Khóa')->first();
        $danhgia = chidoan::leftJoin('danhgiacd', 'danhgiacd.macd', '=', 'chidoan.macd')
                ->leftJoin('dotdg', 'danhgiacd.madot', '=', 'dotdg.madot')
                ->leftJoin('loaicd', 'danhgiacd.maloaicd', '=', 'loaicd.id')
                ->where(function ($query) {
                    $query->where('dotdg.trangthai', '!=', 'Khóa')
                        ->orWhereNull('dotdg.trangthai');
                })
                ->orderBy('chidoan.macd')
                ->get(['danhgiacd.*', 'chidoan.*', 'dotdg.*', 'loaicd.*']);

        return view('doanvien.danhgiacd', compact(['danhgia', 'dotdg']));    
    }

    public function dgchidoan(Request $request)
    {
        $macd = $request->get('cd');        
        $dotdg = dotdg::where('trangthai', '!=', 'Khóa')->first();
        $loaicd = loaicd::all();
        $xeploaicd = danhgiacd::with('chidoan', 'loaicd')->where('macd', $macd)->where('madot', $dotdg->madot)->first();

        $tcloai = DB::table('loaidv')->pluck('tenloaidv')->toArray();
        $xeploai = [];
        $slg = DB::table('danhgiadv')
            ->select('loaidv.tenloaidv', DB::raw('COUNT(*) as soLuong'))
            ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
            ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id') 
            ->where('doanvien.macd', $macd)
            ->groupBy('loaidv.tenloaidv') 
            ->get();

        $tong = $slg->sum('soLuong');

        foreach ($tcloai as $loai) {
            $item = $slg->firstWhere('tenloaidv', $loai);
            
            if ($item) {
                $soLuong = $item->soLuong;
                $phanTram = ($tong > 0) ? ($soLuong / $tong) * 100 : 0;
                $phanTram = number_format($phanTram, 2);
                $xeploai[] = ['loaidv' => $item->tenloaidv, 'tile' => $phanTram];
            } else {
                $xeploai[] = ['loaidv' => $loai, 'tile' => 0];
            }
        }
        return view('doanvien.dgchidoan', compact(['xeploai', 'dotdg', 'macd', 'xeploaicd', 'loaicd']));
    }

    // trang chi đoàn đánh giá
    public function cddanhgia(Request $request)
    {
        $madv = Auth::guard('doanvien')->user()->username;
        $macd = doanvien::where('madv', $madv)->value('macd');
        $bm = bieumau::where('tenbm', 'HD đánh giá, xếp loại chất lượng hằng năm đối với tổ chức Đoàn, tập thể lãnh đạo và cá nhân')->first();

        $dotdg = dotdg::where('trangthai', '!=', 'Khóa')
                    ->where('tgbatdau', '<=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->where('tgketthuc', '>=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->first();
        if($dotdg){
            $xeploaicd = danhgiacd::with('loaicd', 'chidoan')->where('macd', $macd)->where('madot', $dotdg->madot)->first();
            $loaicd = loaicd::all();     

            $tcloai = DB::table('loaidv')->pluck('tenloaidv')->toArray();
            $xeploai = [];
            $slg = DB::table('danhgiadv')
                ->select('loaidv.tenloaidv', DB::raw('COUNT(*) as soLuong'))
                ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
                ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id') 
                ->where('doanvien.macd', $macd)
                ->groupBy('loaidv.tenloaidv') 
                ->get();
    
            $tong = $slg->sum('soLuong');
    
            foreach ($tcloai as $loai) {
                $item = $slg->firstWhere('tenloaidv', $loai);
                
                if ($item) {
                    $soLuong = $item->soLuong;
                    $phanTram = ($tong > 0) ? ($soLuong / $tong) * 100 : 0;
                    $phanTram = number_format($phanTram, 2);
                    $xeploai[] = ['loaidv' => $item->tenloaidv, 'tile' => $phanTram];
                } else {
                    $xeploai[] = ['loaidv' => $loai, 'tile' => 0];
                }
            }

            return view('doanvien.cddanhgia', compact(['xeploai', 'dotdg', 'xeploaicd', 'macd', 'loaicd', 'bm']));
        }
        else{
            return view('doanvien.cddanhgia', compact('dotdg'));
        }             
    }
    // chi đoàn tự đánh giá
    public function cddg(Request $request)
    {
        $dot = $request->input('txtmadot');
        $chidoan = $request->input('txtmacd');
        $loai = $request->input('slloai');

        $count = DB::table('danhgiacd')->where('madot', $dot)->where('macd', $chidoan)->count();

        if($count > 0){
            DB::table('danhgiacd')
                ->where('madot', $dot)->where('macd', $chidoan)
                ->update([
                    'maloaicd' => $loai
                ]);
            return redirect()->back()->with('success', 'Đánh giá thành công');
        }
        else{
            $dg = new danhgiacd();
            $dg->macd = $chidoan;
            $dg->maloaicd = $loai;
            $dg->madot = $dot;
            $dg->save();
    
            return redirect()->back()->with('success', 'Đánh giá thành công');
        }
    }

    // đoàn viên đánh giá
    public function dvdanhgia(Request $request)
    {
        $madv = Auth::guard('doanvien')->user()->username;

        $dotdg = dotdg::where('trangthai', '!=', 'Khóa')
                    ->where('tgbatdau', '<=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->where('tgketthuc', '>=', Carbon::now('Asia/Ho_Chi_Minh'))
                    ->first();
        
        if($dotdg){
            $xeploai = danhgiadv::with('loaidv', 'doanvien')->where('madv', $madv)->where('madot', $dotdg->madot)->first();
            $tcdat = dattc::where('madv', $madv)->pluck('matc')->toArray();
            $mcdat = dattc::where('madv', $madv)->pluck('minhchung')->toArray();
            $tieuchi = tieuchi::all();
            
            return view('doanvien.dvdanhgia', compact(['tieuchi', 'dotdg', 'tcdat', 'mcdat', 'xeploai']));
        }
        else{
            return view('doanvien.dvdanhgia', compact('dotdg'));
        }             
    }
    //tiêu chí đoàn viên đạt
    public function tcdat(Request $request)
    {
        $madv = Auth::guard('doanvien')->user()->username;
        $madotA = $request->input('txtmadot');
        $matcArray = $request->input('cbmatc');
        $minhchungA = $request->input('txtminhchung');

        dattc::where('madv', $madv)
            ->where('madot', $madotA)
            ->delete();

        if ($matcArray) {
            foreach ($matcArray as $key => $matc) {
                if ($matc) {
                    $tieuchi = new dattc([
                        'madv' => $madv,
                        'matc' => $matc,
                        'madot' => $madotA[$key], 
                        'minhchung' => $minhchungA[$matc],
                    ]);
                    $tieuchi->save() ;
                }
            }          
        }

        //lấy mã xếp loại đoàn viên
        $count = dattc::where('madv', $madv)->where('madot', $madotA[0])->count();
        $soTC = tieuchi::all()->count();

        if(($soTC *0.8) < $count){
            $tenloai = "Hoàn thành xuất sắc";
        }
        else if(($soTC * 0.6) < $count && $count <= ($soTC * 0.8)){
            $tenloai = "Hoàn thành tốt";
        }
        else if(($soTC * 0.3) < $count && $count <= ($soTC * 0.6)){
            $tenloai = "Hoàn thành";
        }
        else if($count <= ($soTC * 0.3)){
            $tenloai = "Không hoàn thành";
        }
        
        $maloai = loaidv::where('tenloaidv', $tenloai)->value('id');

        $dvdg = danhgiadv::where('madv', $madv)->where('madot', $madotA[0])->first();

        //lưu/ cập nhật xếp loại theo đọt
        if($dvdg){
            DB::table('danhgiadv')
                ->where('madot', $madotA[0])->where('madv', $madv)
                ->update([
                    'maloaidv' => $maloai
                ]);
        }
        else{
            $xl = new danhgiadv();
            $xl->madv = $madv;
            $xl->maloaidv = $maloai;
            $xl->madot = $madotA[0];
            $xl->save();
        }
        return redirect('/ktcn/dvdanhgia')->with('success', 'Đánh giá thành công.');
    }
    //ds xếp loại đoàn viên
    public function danhgiadv()
    {
        $user = Auth::guard('doanvien')->user();
        $macd = doanvien::where('madv', $user->username)->value('macd');
        $dotdg = Dotdg::where('trangthai', '!=', 'Khóa')
            ->where('tgbatdau', '<=', Carbon::now('Asia/Ho_Chi_Minh'))
            ->where('tgketthuc', '>=', Carbon::now('Asia/Ho_Chi_Minh'))
            ->first();

        if($user->role == 1){
            $danhgia = doanvien::leftJoin('danhgiadv', 'danhgiadv.madv', '=', 'doanvien.madv')
                    ->leftJoin('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
                    ->leftJoin('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
                    ->where(function ($query) {
                        $query->where('dotdg.trangthai', '!=', 'Khóa')
                            ->orWhereNull('dotdg.trangthai');
                    })
                    ->orderBy('doanvien.macd')
                    ->get(['danhgiadv.*', 'doanvien.*', 'dotdg.*', 'loaidv.*']);
        }
        else{
            $danhgia = doanvien::leftJoin('danhgiadv', 'danhgiadv.madv', '=', 'doanvien.madv')
                    ->leftJoin('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
                    ->leftJoin('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
                    ->where('doanvien.macd', $macd)
                    ->where(function ($query) {
                        $query->where('dotdg.trangthai', '!=', 'Khóa')
                            ->orWhereNull('dotdg.trangthai');
                    })
                    ->orderBy('doanvien.macd')
                    ->get(['danhgiadv.*', 'doanvien.*', 'dotdg.*', 'loaidv.*']);
        }
        return view('doanvien.danhgiadv', compact(['danhgia', 'dotdg']));
        
    }
    //đánh giá từng đoàn viên
    public function dgcanhan(Request $request)
    {
        $madv = $request->get('dv');

        $dotdg = Dotdg::where('trangthai', '!=', 'Khóa')
            ->where('tgbatdau', '<=', Carbon::now('Asia/Ho_Chi_Minh'))
            ->where('tgketthuc', '>=', Carbon::now('Asia/Ho_Chi_Minh'))
            ->first();

        if($dotdg){
            $xeploai = danhgiadv::with('loaidv', 'doanvien')->where('madv', $madv)->where('madot', $dotdg->madot)->first();
            $tcdat = dattc::where('madv', $madv)->pluck('matc')->toArray();
            $mcdat = dattc::where('madv', $madv)->pluck('minhchung')->toArray();
            $tieuchi = tieuchi::all();
            
            return view('doanvien.dgcanhan', compact(['tieuchi', 'dotdg', 'tcdat', 'mcdat', 'xeploai', 'madv']));
        }
        else{
            return view('doanvien.dgcanhan', compact('dotdg'));
        }     
    }
    //bch đánh giá
    public function bchdanhgia(Request $request)
    {
        $madvA = $request->input('txtmadv');
        $madotA = $request->input('txtmadot');
        $matcArray = $request->input('cbmatc');
        $minhchungA = $request->input('txtminhchung');        

        dattc::where('madv', $madvA)
            ->where('madot', $madotA)
            ->delete();

        if ($matcArray) {
            foreach ($matcArray as $key => $matc) {
                if ($matc) {    
                    $tieuchi = new dattc([
                        'madv' => $madvA[$key],
                        'matc' => $matc,
                        'madot' => $madotA[$key], 
                        'minhchung' => $minhchungA[$matc],
                    ]);
                    $tieuchi->save();
                }
            }          
        }

        $count = dattc::where('madv', $madvA[0])->where('madot', $madotA[0])->count();
        $soTC = tieuchi::all()->count();

        if(($soTC *0.8) < $count){
            $tenloai = "Hoàn thành xuất sắc";
        }
        else if(($soTC * 0.6) < $count && $count <= ($soTC * 0.8)){
            $tenloai = "Hoàn thành tốt";
        }
        else if(($soTC * 0.3) < $count && $count <= ($soTC * 0.6)){
            $tenloai = "Hoàn thành";
        }
        else if($count <= ($soTC * 0.3)){
            $tenloai = "Không hoàn thành";
        }
        
        $maloai = loaidv::where('tenloaidv', $tenloai)->value('id');

        $dvdg = danhgiadv::where('madv', $madvA[0])->where('madot', $madotA[0])->first();

        //lưu/ cập nhật xếp loại theo đọt
        if($dvdg){
            DB::table('danhgiadv')
                ->where('madot', $madotA[0])->where('madv', $madvA[0])
                ->update([
                    'maloaidv' => $maloai
                ]);
        }
        else{
            $xl = new danhgiadv();
            $xl->madv = $madvA[0];
            $xl->maloaidv = $maloai;
            $xl->madot = $madotA[0];
            $xl->save();
        }
        return redirect('/ktcn/danhgiadv')->with('success', 'Đánh giá thành công.');
    }
    public function ketquadv(){
        $madv = Auth::guard('doanvien')->user()->username;
        $dotdg = dotdg::where('trangthai', 'Khóa')->get();
        $loaidv = loaidv::all();
        //$danhgia = danhgiadv::with(['doanvien', 'dotdg', 'loaidv'])->orderBy('madot')->get();
        $danhgia = DB::table('danhgiadv')
            ->join('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
            ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
            ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
            ->where('dotdg.trangthai', '=', 'khóa')
            ->select('danhgiadv.*', 'dotdg.*', 'doanvien.*', 'loaidv.*')
            ->orderBy('danhgiadv.madot')
            ->orderBy('doanvien.macd')
            ->get();

        $canhan = DB::table('danhgiadv')
            ->join('dotdg', 'danhgiadv.madot', '=', 'dotdg.madot')
            ->join('doanvien', 'danhgiadv.madv', '=', 'doanvien.madv')
            ->join('loaidv', 'danhgiadv.maloaidv', '=', 'loaidv.id')
            ->where('dotdg.trangthai', '=', 'khóa')
            ->where('doanvien.madv', $madv)
            ->select('danhgiadv.*', 'dotdg.*', 'doanvien.*', 'loaidv.*')
            ->orderBy('danhgiadv.madot')
            ->orderBy('doanvien.macd')
            ->get();

        return view('doanvien.ketquadv', compact(['dotdg', 'loaidv', 'danhgia', 'canhan']));
    }

    public function ketquacd(){
        $user = Auth::guard('doanvien')->user();
        $macd = doanvien::where('madv', $user->username)->value('macd');
        $dotdg = dotdg::where('trangthai', 'Khóa')->get();
        $loaicd = loaicd::all();

        $danhgia = DB::table('danhgiacd')
            ->join('dotdg', 'danhgiacd.madot', '=', 'dotdg.madot')
            ->join('chidoan', 'danhgiacd.macd', '=', 'chidoan.macd')
            ->join('loaicd', 'danhgiacd.maloaicd', '=', 'loaicd.id')
            ->where('dotdg.trangthai', '=', 'khóa')
            ->select('danhgiacd.*', 'dotdg.*', 'chidoan.*', 'loaicd.*')
            ->orderBy('danhgiacd.madot')
            ->orderBy('chidoan.macd')
            ->get();
        
        $chidoan = DB::table('danhgiacd')
            ->join('dotdg', 'danhgiacd.madot', '=', 'dotdg.madot')
            ->join('chidoan', 'danhgiacd.macd', '=', 'chidoan.macd')
            ->join('loaicd', 'danhgiacd.maloaicd', '=', 'loaicd.id')
            ->where('dotdg.trangthai', '=', 'khóa')
            ->where('chidoan.macd', $macd)
            ->select('danhgiacd.*', 'dotdg.*', 'chidoan.*', 'loaicd.*')
            ->orderBy('danhgiacd.madot')
            ->orderBy('chidoan.macd')
            ->get();

        return view('doanvien.ketquacd', compact(['dotdg', 'loaicd', 'danhgia', 'chidoan']));
    }

}
