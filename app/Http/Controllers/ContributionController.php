<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContributionModel;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ContributionController extends Controller
{
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
                $tempDirectory1 = 'C:\xampp\htdocs\arduino\resources\temp\ZIP';
                if (!file_exists($tempDirectory1)) {
                    mkdir($tempDirectory1, 0777, true);
                }

                // Tạo tên file tạm thời dựa trên ID của bản ghi
                $tempFileName = 'document_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.docx';
                $tempFileName1 = 'contributions_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.zip';

                // Tạo đường dẫn tệp tạm thời
                $tempFilePath = $tempDirectory . '/' . $tempFileName;
                $tempFilePath1 = $tempDirectory1 . '/' . $tempFileName1;

                // Ghi dữ liệu vào tệp tạm thời
                file_put_contents($tempFilePath, $fileData);
                file_put_contents($tempFilePath1, $fileData);

                // Lưu tên tệp và đường dẫn vào đối tượng contribution
                $contribution->file_name_docx = $tempFileName;
                $contribution->file_path_docx = $tempFilePath;
                $contribution->file_name_zip = $tempFileName1;
                $contribution->file_path_zip = $tempFilePath1;
            }
        }

        // Trả về view với danh sách bản ghi đã lọc và xử lý
        return view('contributions.list-contribution', ['list_contribution' => $list_contribution]);
    }
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
    //             $tempDirectoryZip = 'C:\xampp\htdocs\arduino\resources\temp\ZIP';
    //             if (!file_exists($tempDirectoryZip)) {
    //                 mkdir($tempDirectoryZip, 0777, true);
    //             }

    //             // Tạo tên file tạm thời dựa trên ID của bản ghi
    //             $tempFileName = 'document_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name .'_' . $contribution->faculty_id. '.docx';
    //             $tempFileNameZip = 'contributions_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '.zip';

    //             // Tạo đường dẫn tệp tạm thời
    //             $tempFilePath = $tempDirectory . '/' . $tempFileName;
    //             $tempFilePathZip = $tempDirectoryZip . '/' . $tempFileNameZip;

    //             // Ghi dữ liệu vào tệp tạm thời
    //             file_put_contents($tempFilePath, $fileData);

    //             // Tạo tệp zip và lưu các tệp docx vào đó
    //             $zip = new \ZipArchive();
    //             if ($zip->open($tempFilePathZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
    //                 $zip->addFile($tempFilePath, $tempFileName);
    //                 $zip->close();
    //             }

    //             // Lưu tên tệp và đường dẫn vào đối tượng contribution
    //             $contribution->file_name_docx = $tempFileName;
    //             $contribution->file_path_docx = $tempFilePath;
    //             $contribution->file_name_zip = $tempFileNameZip;
    //             $contribution->file_path_zip = $tempFilePathZip;
    //         }
    //     }

    //     // Trả về view với danh sách bản ghi đã lọc và xử lý
    //     return view('contributions.list-contribution', ['list_contribution' => $list_contribution]);
    // }





    public function download_All_Contributions(Request $request)
    {
        // Lấy tất cả contribution_id của bài tập đã hết hạn dựa vào expiration_date
        $expiredContributionIds = ContributionModel::where('expiration_date', '<', now())->pluck('contribution_id')->toArray();

    // Tạo thư mục lưu trữ tệp docx đã hết hạn
    $docxDirectory = 'C:\xampp\htdocs\arduino\resources\temp\documentOut';
    if (!file_exists($docxDirectory)) {
        mkdir($docxDirectory, 0777, true);
    }

    // Lấy thông tin của các bài tập dựa trên contribution_id đã hết hạn và lưu vào thư mục documentOut
    foreach ($expiredContributionIds as $contributionId) {
        $contribution = ContributionModel::where('contribution_id', $contributionId)->first();
        if ($contribution) {
            $docxFileName = 'documentOut_' . $contribution->contribution_id . '_' . $contribution->student_id . '_' . $contribution->faculty_id . '_' . $contribution->faculty_name . '_' . $contribution->faculty_id . '.docx';
            $docxFilePath = $docxDirectory . DIRECTORY_SEPARATOR . $docxFileName;

            // Kiểm tra xem tệp docx đã tồn tại hay chưa trước khi lưu
            if (!file_exists($docxFilePath)) {
                // Lưu tệp docx
                $fileData = $contribution->word_document;
                file_put_contents($docxFilePath, $fileData);
            }
        }
    }

    // Tạo tệp ZIP chứa các tệp docx đã hết hạn
    $zip = new ZipArchive;
    $zipFileName = 'all_expired_contributions_' . now()->format('YmdHis') . '.zip';
    $zipFilePath = 'C:\xampp\htdocs\arduino\resources\temp\ZIP\\' . $zipFileName;

    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return response()->json(['error' => 'Failed to create ZIP file'], 500);
    }

    // Thêm các tệp docx đã hết hạn vào tệp ZIP từ thư mục documentOut
    $docxFiles = glob($docxDirectory . '/*.docx');
    foreach ($docxFiles as $docxFilePath) {
        $docxFileName = pathinfo($docxFilePath, PATHINFO_BASENAME);
        $zip->addFile($docxFilePath, $docxFileName);
    }

    $zip->close();

    // Xóa các tệp docx đã lưu trong thư mục documentOut
    array_map('unlink', glob("$docxDirectory/*.*"));
    rmdir($docxDirectory);

    // Trả về tệp ZIP đã tạo
    return response()->download($zipFilePath, $zipFileName);
    }







}
