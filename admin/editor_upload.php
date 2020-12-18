<?php
include_once 'includes/config/app.php';
require_once 'includes/classes/uploader.php';

$errors = [];
if(isset($_FILES['upload']['name'])) {
    $allowedTypes = [
        'jpg' =>'image/jpeg',
        'png' =>'image/png',
        'gif' =>'image/gif'
    ];

    $upload = new Uploader('uploads/posts_image', $allowedTypes, $config['root_dir']);
    $upload->file = $_FILES['upload'];
    $errors = $upload->upload();

    $filePath = $upload->filePath;

    if (!count($errors)) {
        $function_number = $_GET['CKEditorFuncNum'];
        $url = $config['main_app_url'] . $filePath;
        $message = '';
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
    }

}
