<?php
session_start();
include('config/connection.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$writer = new Xlsx($spreadsheet);

$upload_dir = '../asset/image/';
$allowed_types = array('jpg', 'png', 'jpeg');
//$maxsize = 2 * 1024 * 1024;
$final_result = true;
$msg = "";
$counter = 0;
$error_array = array();
$image_excel_file = "image_upload_" . date("Y-m-d") . "-" . rand(10, 1000) . ".xlsx";

if (!empty(array_filter($_FILES['files']['name']))) {

$i=0;
    foreach ($_FILES['files']['tmp_name'] as $key => $value) {

        $file_tmpname = $_FILES['files']['tmp_name'][$key];
        $file_name = $_FILES['files']['name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $fileinfo = @getimagesize($file_tmpname);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = explode(".", $file_name);

        $newfilename = $temp[0].round(microtime(true)). $i . '.' . $temp[1];
  
        // Set upload file path
        $filepath = $upload_dir .'product/'. $newfilename;

        // Check file type is allowed or not
        if (in_array(strtolower($file_ext), $allowed_types)) {
            // Verify file size - 2MB max 
        

            // $file_array = scandir($upload_dir.'products/'); 
// scandir($upload_dir.'products/');

            // if (array_search($file_name, $file_array)) {
            //     $msg =  "Error: File " . $file_name . " is duplicate!.";
            //     $error_array[$file_name] = $msg;
            //     continue;
            // }


            if ($height < 600) {
                $msg = "Error: File " . $file_name . " height is less then 600px.";
                $error_array[$file_name] = $msg;
                continue;
            }
            
             if ($width < 500) {
                $msg = "Error: File " . $file_name . " width is less then 500px.";
                $error_array[$file_name] = $msg;
                continue;
            }

            // 
                if (move_uploaded_file($file_tmpname, $filepath)) {

                $sheet->setCellValue('A1', 'IMAGE NAME');
                $sheet->setCellValue('B1', 'IMAGE URL');
                $counter = $counter + 1;
                $c = $counter + 1;
                $sheet->setCellValue('A' . $c, $newfilename);
                $exploded_path = explode('asset',$filepath);
                $new_path = './asset'.$exploded_path[1];
                $sheet->setCellValue('B' . $c, $new_path);
                $writer->save($upload_dir.'image_excel_files/' . $image_excel_file);
            } else {
                $msg = "Error uploading in file " . $file_name;
                $error_array[$file_name] = $msg;
                continue;
            }
        } else {
            $msg = "Error uploading in fle " . $file_name . " file type " . $file_ext . " is not allowed";
            $error_array[$file_name] = $msg;
            continue;
        }
        $i++;
    }
} else {
    $final_result = false;
    $msg =  "No files selected.";
}

if ($final_result) {
    if ($counter > 0) {
        $upload_images = array(
            'date' => date("Y-m-d"),
            'time' => date("H:i:s"),
            'image_count' => $counter,
            'file_path' => $upload_dir.'image_excel_files/' . $image_excel_file
        );

    if (count($error_array) > 0) {
                $error_spreadsheet = new Spreadsheet();
                $error_sheet = $error_spreadsheet->getActiveSheet();
                $writer = new Xlsx($error_spreadsheet);
                $n = 2;
                foreach ($error_array as $k => $v) {

                    $error_sheet->setCellValue('A1', 'IMAGE NAME');
                    $error_sheet->setCellValue('B1', 'ERROR');
                    $error_sheet->setCellValue('A' . $n, $k);
                    $error_sheet->setCellValue('B' . $n, $v);
                    $writer->save('errors.xlsx');
                    $n++;
                }
                echo json_encode(['status' => 1, 'msg' => $msg, 'no_error' => 1, 'sheet' => $upload_images['file_path']]);
            } else {
                echo json_encode(['status' => 1, 'msg' => $msg, 'no_error' => 0, 'sheet' => $upload_images['file_path']]);
            }
        
    } else {

        if (count($_FILES['files']['name']) == ($key + 1)) {
            $msg = 'All files are duplicate!';
        }
        echo json_encode(['status' => 0, 'msg' => $msg]);
    }
} else {
    echo json_encode(['status' => 0, 'msg' => $msg]);
}
