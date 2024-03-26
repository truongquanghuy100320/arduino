<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContributionModel;
use ZipArchive;

class ContributionController extends Controller
{
    // public function list_contribution()
    // {
    //     // Lấy danh sách các bản ghi có dữ liệu trong cột 'word_document'
    //     $list_contribution = ContributionModel::all();

    //     // Duyệt qua từng contribution trong danh sách và xử lý dữ liệu
    //     foreach ($list_contribution as $contribution) {
    //         // Kiểm tra xem contribution có dữ liệu word_document không
    //         if ($contribution->word_document) {
    //             // Tiến hành xử lý và lưu tệp tạm thời nếu cần thiết
    //             $fileData = $contribution->word_document;

    //             // Tạo thư mục tạm thời nếu chưa tồn tại
    //             $tempDirectory = 'C:\xampp\htdocs\arduino\resources\temp\document';
    //             if (!file_exists($tempDirectory)) {
    //                 mkdir($tempDirectory, 0777, true);
    //             }
    //             $tempDirectory1 = 'C:\xampp\htdocs\arduino\resources\temp\ZIP';
    //             if (!file_exists($tempDirectory1)) {
    //                 mkdir($tempDirectory1, 0777, true);
    //             }

    //             // Tạo tên file tạm thời dựa trên ID của bản ghi
    //             $tempFileName = 'document_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.docx';
    //             $tempFileName1 = 'contributions_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.zip';

    //             // Tạo đường dẫn tệp tạm thời
    //             $tempFilePath = $tempDirectory . '/' . $tempFileName;
    //             $tempFilePath1 = $tempDirectory1 . '/' . $tempFileName1;

    //             // Ghi dữ liệu vào tệp tạm thời
    //             file_put_contents($tempFilePath, $fileData);
    //             file_put_contents($tempFilePath1, $fileData);

    //             // Lưu tên tệp và đường dẫn vào đối tượng contribution
    //             $contribution->file_name_docx = $tempFileName;
    //             $contribution->file_path_docx = $tempFilePath;
    //             $contribution->file_name_zip = $tempFileName1;
    //             $contribution->file_path_zip = $tempFilePath1;
    //         }
    //     }

    //     // Trả về view với danh sách bản ghi đã lọc và xử lý
    //     return view('contributions.list-contribution', ['list_contribution' => $list_contribution]);
    // }
    public function list_contribution()
    {
        // Lấy danh sách các bản ghi có dữ liệu trong cột 'word_document'
        $list_contribution = ContributionModel::all();

        // Duyệt qua từng contribution trong danh sách và xử lý dữ liệu
        foreach ($list_contribution as $contribution) {
            // Kiểm tra xem contribution có dữ liệu word_document không
            if ($contribution->word_document) {
                // Tiến hành xử lý và lưu tệp tạm thời nếu cần thiết
                $fileData = $contribution->word_document;

                // Tạo thư mục tạm thời nếu chưa tồn tại
                $tempDirectory = 'C:\xampp\htdocs\arduino\resources\temp\document';
                if (!file_exists($tempDirectory)) {
                    mkdir($tempDirectory, 0777, true);
                }
                $tempDirectoryZip = 'C:\xampp\htdocs\arduino\resources\temp\ZIP';
                if (!file_exists($tempDirectoryZip)) {
                    mkdir($tempDirectoryZip, 0777, true);
                }

                // Tạo tên file tạm thời dựa trên ID của bản ghi
                $tempFileName = 'document_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.docx';
                $tempFileNameZip = 'contributions_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.zip';

                // Tạo đường dẫn tệp tạm thời
                $tempFilePath = $tempDirectory . '/' . $tempFileName;
                $tempFilePathZip = $tempDirectoryZip . '/' . $tempFileNameZip;

                // Ghi dữ liệu vào tệp tạm thời
                file_put_contents($tempFilePath, $fileData);

                // Tạo tệp zip và lưu các tệp docx vào đó
                $zip = new \ZipArchive();
                if ($zip->open($tempFilePathZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                    $zip->addFile($tempFilePath, $tempFileName);
                    $zip->close();
                }

                // Lưu tên tệp và đường dẫn vào đối tượng contribution
                $contribution->file_name_docx = $tempFileName;
                $contribution->file_path_docx = $tempFilePath;
                $contribution->file_name_zip = $tempFileNameZip;
                $contribution->file_path_zip = $tempFilePathZip;
            }
        }

        // Trả về view với danh sách bản ghi đã lọc và xử lý
        return view('contributions.list-contribution', ['list_contribution' => $list_contribution]);
    }




}