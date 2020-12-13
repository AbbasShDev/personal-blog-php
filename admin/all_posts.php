<?php
ob_start();
session_start();
$page_title = 'كل المقالات';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/classes/uploader.php';
include_once 'includes/templates/admin_header.php';

if (isset($_POST['delete_post'])){

    $image_stat = $mysqli->prepare('SELECT post_image FROM posts WHERE id=?');
    $image_stat->bind_param('i', $_POST['post_id']);
    $image_stat->execute();
    $post_image = $config['root_dir'].$image_stat->get_result()->fetch_assoc()['post_image'];
    //delete post image
    unlink($post_image) ;

    $delete_stat = $mysqli->prepare("DELETE FROM posts WHERE id=?");
    $delete_stat->bind_param('i', $_POST['post_id']);

    if ($delete_stat->execute()){
        $_SESSION['notify_message'] = 'تم حذف المقال';
        header("location: all_posts");
        die();
    }else{
        $_SESSION['error_message'] = 'حدثت مشكلة اثناء حذف المقال';
        header("location: all_posts");
        die();
    }
}
$errors = [];
if (isset($_POST['edit-post'])){


    $post_id = $_POST['post-id'];
    $post_title = $_POST['post-title'];
    $post_category = $_POST['post-cat'];
    $post_content = $_POST['post-content'];

    if (empty($post_title)){$errors[] = 'حقل عنوان المقال فارغ.';}
    if (empty($post_category)){$errors[] = 'حقل التصنيف فارغ.';}
    if (empty($post_content)){$errors[] = 'حقل نص المقال فارغ.';}

    if (!count($errors)){
        $image_stat = $mysqli->prepare('SELECT post_image FROM posts WHERE id=?');
        $image_stat->bind_param('i', $post_id);
        $image_stat->execute();
        $post_image = $image_stat->get_result()->fetch_assoc()['post_image'];
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

        if (!count($errors)){
            //delete old post image.
            $old_image = $config['root_dir'].$post_image;
            unlink($old_image) ;
            $post_image = $upload->filePath;
        }

    }

    if (!count($errors)){
        $stat = $mysqli->prepare('UPDATE posts SET post_title=?, post_category=?, post_content=?, post_image=? WHERE id=?');
        $stat->bind_param('sissi', $post_title, $post_category, $post_content, $post_image, $post_id);

        if ($stat->execute()){
            $_SESSION['notify_message'] = 'تم تعديل المقال';
            header("location: all_posts");
            die();
        }else {
            $_SESSION['error_message'] = 'حدثت مشكلة اثناء تعديل المقال';
            header("location: all_posts");
            die();
        }
    }


}

?>
    <!-- Edit post modal -->
    <div class="modal fade bd-example-modal-lg" id="edit-post-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل المقال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="all_posts" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="post-id" id="post-id">
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
                            <p class="text-muted mt-1"><small>اترك الحقل فارغ في حال عدم الرغبة بتغير الصورة</small></p>
                        </div>
                        <div class="form-group">
                            <label for="post-content">نص المقال</label>
                            <textarea name="post-content" id="post-content" class="form-control"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" name="edit-post" class="btn btn-custom">حفظ التعغيرات</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Start Main content -->
    <div class="col-md-10 main-content" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <h4 class="p-3">كل المقالات</h4>
        <div class="container">
            <?php include_once 'includes/config/errorMessages.php';?>
            <div class="display-posts mt-2">
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="min-width: 105px">صورة المقال</th>
                        <th style="min-width: 90px">اسم الناشر</th>
                        <th style="min-width: 326px">عنوان المقال</th>
                        <th style="min-width: 113px">تصنيف المقال</th>
                        <th style="min-width: 114px">تاريخ الإضافة</th>
                        <th style="min-width: 180px">تعديل | حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stst2 = $mysqli->query('SELECT posts.*, categories.category_name FROM posts INNER JOIN categories ON posts.post_category=categories.id ORDER BY id DESC');
                    $posts = $stst2->fetch_all(MYSQLI_ASSOC);
                    foreach ($posts as $post) : ?>
                        <tr>
                            <th><?php echo $post['id']?></th>
                            <th>
                                <img
                                        width="60" height="40"
                                        src="<?php echo '../'.$post['post_image']?>"
                                        alt="post image"
                                >
                            </th>
                            <td><?php echo $post['post_author']?></td>
                            <td><?php echo $post['post_title']?></td>
                            <td><?php echo $post['category_name']?></td>
                            <td><?php echo $post['post_date']?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-success btn-sm mx-1 edit-post-btn" data-post_id="<?php echo $post['id']?>" data-toggle="modal" data-target="#edit-post-modal">
                                        <i class="fa fa-edit"></i>
                                        تعديل
                                    </button>
                                    <form action="" method="post">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']?>">
                                        <button type="submit" name="delete_post" onclick="return confirm('هل تريد حذف المقال؟')"  class="btn btn-danger btn-sm mx-1"><i class="fas fa-backspace"></i> حذف</ </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Main content -->
    </div>

<?php include_once 'includes/templates/admin_footer.php'; ?>