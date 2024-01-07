<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Doanvien;
use App\Imports\DVImport;

class ImExController extends Controller
{
    public function xuatdv()
    {
        $doanvien = DoanVien::all();
        return view('xuatdv', compact('doanvien'));
    }

    public function nhapdv(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new DVImport, $path);
        return back()->with('success', 'Thêm thành công');
    }
}
