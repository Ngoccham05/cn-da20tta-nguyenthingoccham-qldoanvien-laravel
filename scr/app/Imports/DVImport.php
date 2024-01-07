<?php

namespace App\Imports;

use App\Models\doanvien;
use App\Models\chucvu;
use App\Models\tkdoanvien;
use Maatwebsite\Excel\Concerns\ToModel;

class DVImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] !== null) {
            $count = Doanvien::where('madv', $row[0])->count();
    
            if ($count == 0) {
                $chucvu = Chucvu::where('tencv', $row[9])->first();
    
                $doanvien = new Doanvien([
                    'madv' => $row[0],
                    'hoten' => $row[1],
                    'gioitinh' => $row[2],
                    'ngaysinh' => $row[3],
                    'sdt' => $row[4],
                    'diachi' => $row[5],
                    'ngayvaodoan' => $row[6],
                    'noivaodoan' => $row[7],
                    'macd' => $row[8],
                    'macv' => $chucvu->id,
                ]);

                $doanvien->save();

                if(stripos($chucvu->tencv, 'Đoàn khoa') !== false){
                    $role = "1";
                }
                else if(stripos($chucvu->tencv, 'Chi đoàn') !== false){
                    $role = "2";  
                }
                else{
                    $role = "3"; 
                }
                $tkdoanvien = new Tkdoanvien([
                    'username' => $row[0],
                    'password' => md5(123456),
                    'active' => "1",
                    'role' => $role,
                ]);
                $tkdoanvien->save();
                
                return $doanvien;
            }           
        }
        return null;
    }
}
