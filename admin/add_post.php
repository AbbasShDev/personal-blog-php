<?php
ob_start();
session_start();
$page_title = 'إضافة مقال';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
require_once 'includes/classes/uploader.php';
include_once 'includes/templates/admin_header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST"){


        $post_title = $_POST['post-title'];
        $post_category = $_POST['post-cat'];
        $post_content = $_POST['post-content'];

        if (empty($post_title)){$errors[] = 'حقل عنوان المقال فارغ.';}
        if (empty($post_category)){$errors[] = 'حقل التصنيف فارغ.';}
        if (empty($post_content)){$errors[] = 'حقل نص المقال فارغ.';}

        if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] == 4){
            $errors[] = 'حقل الصورة فارغ.';
        }


        if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] == 0){


            $allowedTypes = [
                'jpg' =>'image/jpeg',
                'png' =>'image/png',
                'gif' =>'image/gif'
            ];

            $upload = new Uploader('uploads/posts_image', $allowedTypes, $config['root_dir']);
            $upload->file = $_FILES['post-image'];
            $errors = $upload->upload();

            $filePath = $upload->filePath;
        }

        if (!count($errors)){
            $stat = $mysqli->prepare("INSERT INTO posts (post_title, post_category, post_content, post_image) VALUES(?,?,?,?)");
            $stat->bind_param('siss', $post_title, $post_category, $post_content, $filePath);

            if ($stat->execute()){
                $_SESSION['notify_message'] = 'تم إضافة المقال';
                header("location: add_post");
                die();
            }else {
                $_SESSION['error_message'] = 'حدثت مشكلة اثناء إضافة المقال';
                header("location: add_post");
                die();
            }
        }


}

?>
<!-- Start Main content -->
<div class="col-md-10 main-content">
    <h4 class="p-3">إضافة مقال</h4>
    <div class="container">
        <?php include_once 'includes/config/errorMessages.php';?>
        <div class="add-post">
            <form action="add_post" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post-title">عنوان المقال</label>
                    <input type="text" name="post-title" id="post-title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="post-cat">التصنيف</label>
                    <select name="post-cat" id="post-cat" class="custom-select">
                        <?php
                        $cat_stat = $mysqli->query('SELECT * FROM categories');
                        $categories = $cat_stat->fetch_all(MYSQLI_ASSOC);
                        foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-image">صورة المقال</label>
                    <input type="file" name="post-image" id="post-image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="post-content">نص المقال</label>
                    <textarea name="post-content" id="post-content" class="form-control"></textarea>
                </div>
                <button class="btn btn-custom" type="submit">نشر المقال</button>
            </form>
        </div>
    </div>
</div>
<!-- End Main content -->
</div>

<?php include_once 'includes/templates/admin_footer.php'; ?>