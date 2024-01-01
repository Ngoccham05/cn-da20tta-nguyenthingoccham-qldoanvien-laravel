<?php

namespace App\Http\Controllers;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use App\Models\Doanvien;

use Illuminate\Http\Request;

class ImExController extends Controller
{
    public function xuatdv()
    {
        $phpWord = new PhpWord();

        $section = $phpWord->addSection([
            'pageSize' => 'A4',
            'marginLeft' => 567 * 3,   // Lề trái 3 cm
            'marginRight' => 567 * 2,   // Lề phải 2 cm
            'marginTop' => 567 * 2,    // Lề trên 2 cm
            'marginBottom' => 567 * 2, // Lề dưới 2 cm
        ]);

        $title = $section->addText('DANH SÁCH ĐOÀN VIÊN');
        $titleStyle = ['name' => 'Times New Roman', 'size' => 14, 'bold' => true, 'alignment' => 'center'];
        $title->setFontStyle($titleStyle);        

        $doanvien = Doanvien::all();
            
        // Kiểm tra xem có dữ liệu hay không
        if ($doanvien->count() > 0) {
            $cellStyle = ['name' => 'Times New Roman', 'size' => 13];
            $tableWidthInCm = 16;
            $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'width' => '\PhpOffice\PhpWord\Shared\Converter::cmToTwip($tableWidthInCm)']);

            // Thêm tiêu đề cột cho bảng
            $table->addRow();
            $headerCellStyle = ['align' => 'center', 'bold' => true];
            $widthCell = 567; // (1cm * 567 twip/cm)
            $cell = $table->addCell($widthCell * 1.5, $cellStyle);
            $cell->addText('STT', $cellStyle, ['alignment' => 'center']);

            $table->addCell($widthCell * 2.5, $headerCellStyle)->addText('MSSV')->setFontStyle($cellStyle);
            $table->addCell($widthCell * 6, $headerCellStyle)->addText('Họ tên')->setFontStyle($cellStyle);
            $table->addCell($widthCell * 3, $headerCellStyle)->addText('Chi đoàn')->setFontStyle($cellStyle);
            $table->addCell($widthCell * 3, $headerCellStyle)->addText('Ghi chú')->setFontStyle($cellStyle);

            // Thêm dữ liệu từ cơ sở dữ liệu vào bảng
            $stt = 1; // Số thứ tự ban đầu
            foreach ($doanvien as $dv) {
                $table->addRow();
                
                // Thêm dữ liệu cho cột STT
                $table->addCell($widthCell * 1.5)->addText($stt)->setFontStyle($cellStyle);
                $table->addCell($widthCell * 2.5)->addText($dv->madv)->setFontStyle($cellStyle);
                $table->addCell($widthCell * 6)->addText($dv->hoten)->setFontStyle($cellStyle);
                $table->addCell($widthCell * 3)->addText($dv->macd)->setFontStyle($cellStyle);
                $table->addCell($widthCell * 3)->addText("")->setFontStyle($cellStyle);

                $stt++; // Tăng số thứ tự
            }
        } else {
            // Thông báo nếu không có dữ liệu
            $section->addText('Không có dữ liệu Sinh viên.');
        }

        // Tạo một đối tượng writer cho Word2007
        $writer = new Word2007($phpWord);

        // Lưu tài liệu vào một tệp
        $filename = 'danh_sach_sinh_vien.docx';
        $writer->save(storage_path($filename));

        // Cung cấp một liên kết tải xuống cho người dùng
        return response()->download(storage_path($filename))->deleteFileAfterSend(true);
    }
}
