<?php
ob_start();
session_start();
$page_title = 'الإعدادات';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/admin_header.php';

$author_stat = $mysqli->query('SELECT post_author FROM posts');
$author = $author_stat->fetch_assoc()['post_author'];

if ($_SERVER['REQUEST_METHOD'] == "POST"){


    $post_author = $_POST['post-author'];

    $stat = $mysqli->prepare('UPDATE posts set post_author=?');
    $stat->bind_param('s', $post_author);

    if ($stat->execute()){
        $_SESSION['notify_message'] = 'تم تحديث البيانات';
        header("location: settings");
        die();
    }else {
        $_SESSION['error_message'] = 'حدثت مشكلة تحديث البيانات';
        header("location: settings");
        die();
    }

}

?>

    <!-- Start Main content -->
    <div class="col-md-8 mx-auto main-content">
        <h4 class="p-3">الإعدادات</h4>
        <div class="container">
            <div class="add-post">
                <form action="settings" method="post">
                    <div class="form-group">
                        <label for="post-author">كاتب المقالات</label>
                        <input type="text" name="post-author" id="post-author" class="form-control" value="<?php echo $author; ?>">
                    </div>
                    <button class="btn btn-custom" type="submit">حفظ</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Main content -->
    </div>

<?php include_once 'includes/templates/admin_footer.php'; ?>