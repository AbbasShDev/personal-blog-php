<?php
session_start();

include_once 'includes/config/database.php';

if (isset($_POST['post_id'])){

    $stat = $mysqli->prepare('SELECT * FROM posts WHERE id=?');
    $stat->bind_param('i', $_POST['post_id']);
    $stat->execute();
    $result = $stat->get_result()->fetch_assoc();

    echo json_encode($result);

}

if (isset($_POST['category_id'])){

    $stat = $mysqli->prepare('SELECT * FROM categories WHERE id=?');
    $stat->bind_param('i', $_POST['category_id']);
    $stat->execute();
    $result = $stat->get_result()->fetch_assoc();

    echo json_encode($result);

}


if (isset($_POST['category-name'])){

    $errors = '';
    $cat_id = $_POST['category-id'];
    $cat_name = $_POST['category-name'];

    if (empty($cat_name)){
        $errors = 'حقل التصنيف فارغ.';
        echo $errors;
    }
    if (mb_strlen($cat_name) > 100){
        $errors = 'اسم التصنيف كبير جدا.';
        echo $errors;
    }

    if (empty($errors)){
        $stat = $mysqli->prepare('SELECT category_name FROM categories');
        $stat->execute();
        $categories = $stat->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($categories as $category) {
            if ($category['category_name'] == $cat_name){
                $errors = 'اسم التصنيف موجود.';
                echo $errors;
                break;
            }
        }
    }


    if (empty($errors)){
        $stat = $mysqli->prepare('UPDATE categories SET category_name=? WHERE id=?');
        $stat->bind_param('si', $cat_name, $cat_id);

        if ($stat->execute()){
            $_SESSION['notify_message'] = 'تم تغيير التصنيف';
            echo 'updated successfully';
        }else {
            $_SESSION['error_message'] = 'حدثت مشكلة اثناء إضافة التصنيف';
            echo 'حدثت مشكلة اثناء تغيير التصنيف';
        }
    }

}