<?php
ob_start();
session_start();
$page_title = 'التصنيفات';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/admin_header.php';

$errors = [];

if (isset($_POST['add-category'])){

    $cat_name = $_POST['category-name'];

    if (empty($cat_name)){$errors[] = 'حقل التصنيف فارغ.';}
    if (mb_strlen($cat_name) > 100){$errors[] = 'اسم التصنيف كبير جدا.';}

    if (!count($errors)){
        $stat = $mysqli->prepare('SELECT category_name FROM categories');
        $stat->execute();
        $categories = $stat->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($categories as $category) {
            if ($category['category_name'] == $cat_name){
                $errors[] = 'اسم التصنيف موجود.';
                break;
            }
        }
    }


    if (!count($errors)){
        $stat = $mysqli->prepare('INSERT INTO categories (category_name) VALUES(?)');
        $stat->bind_param('s', $cat_name);

        if ($stat->execute()){
            $_SESSION['notify_message'] = 'تم إضافة التصنيف';
            header("location: categories");
            die();
        }else {
            $_SESSION['error_message'] = 'حدثت مشكلة اثناء إضافة التصنيف';
            header("location: categories");
            die();
        }
    }

}

if (isset($_POST['delete_category'])){

    $delete_stat = $mysqli->prepare("DELETE FROM categories WHERE id=?");
    $delete_stat->bind_param('i', $_POST['category_id']);

    if ($delete_stat->execute()){
        $_SESSION['notify_message'] = 'تم حذف التصنيف';
        header("location: categories");
        die();
    }else{
        $_SESSION['error_message'] = 'حدثت مشكلة اثناء حذف التصنيف';
        header("location: categories");
        die();
    }
}


?>

<!-- Edit category modal -->
<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل التصنيف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger edit-category-errors"></p>
                <form class="edit-category-form">
                    <input type="hidden" name="category-id" id="category-id">
                    <div class="form-group">
                        <label for="category-name">التصنيف</label>
                        <input type="text" name="category-name" id="category-name" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" name="edit-category" class="btn btn-custom">حفظ التعغيرات</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Main content -->
<div class="col-md-10 main-content">
    <h4 class="p-3">التصنيفات</h4>
    <div class="container">
        <?php include_once 'includes/config/errorMessages.php';?>
        <div class="add-category">
            <form action="categories" method="post">
                <div class="form-group">
                    <label for="category-name">تصنيف جديد</label>
                    <input type="text" name="category-name" id="category-name" class="form-control">
                </div>
                <button class="btn btn-custom" type="submit" name="add-category">إضافة</button>
            </form>
        </div>

        <div class="display-categories mt-5">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم التصنيف</th>
                    <th>تاريخ الإضافة</th>
                    <th>تعديل | حذف</th>
                </tr>
                </thead>
                <tbody>
                <?php $stst2 = $mysqli->query('SELECT * FROM categories ORDER BY id DESC');
                    $all_categories = $stst2->fetch_all(MYSQLI_ASSOC);
                    foreach ($all_categories as $cat) : ?>
                        <tr>
                            <th><?php echo $cat['id']?></th>
                            <td><?php echo $cat['category_name']?></td>
                            <td><?php echo $cat['created_at']?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-success btn-sm mx-1 edit-category-btn" data-category_id="<?php echo $cat['id']?>" data-toggle="modal" data-target="#edit-category-modal">
                                        <i class="fa fa-edit"></i>
                                        تعديل
                                    </button>                                    <form action="" method="post">
                                        <input type="hidden" name="category_id" value="<?php echo $cat['id']?>">
                                        <button type="submit" name="delete_category" onclick="return confirm('هل تريد حذف التصنيف؟')" class="btn btn-danger btn-sm mx-1"><i class="fas fa-backspace"></i> حذف</ </button>
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
<?php include_once 'includes/templates/admin_footer.php'; ?>
