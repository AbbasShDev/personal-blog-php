<?php
ob_start();
session_start();
$page_title = 'الإعدادات';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/admin_header.php';

$author_stat = $mysqli->query('SELECT post_author FROM posts');
$author = $author_stat->fetch_assoc()['post_author'];

$admin_stat = $mysqli->query("SELECT * FROM users WHERE user_id=$_SESSION[user_id]");
$admin = $admin_stat->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if (isset($_POST['general-settings'])){

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

    if (isset($_POST['admin-settings'])){

        $admin_name = $_POST['admin-name'];
        $admin_email = $_POST['admin-email'];
        $admin_password = $_POST['admin-password'];

        if (empty($admin_password)){
            $pass = $admin['user_password'];
        }else{
            $pass = password_hash($admin_password, PASSWORD_DEFAULT);
        }

        $stat = $mysqli->prepare("UPDATE users set user_name=?, user_email=?, user_password=? WHERE user_id=$_SESSION[user_id]");
        $stat->bind_param('sss', $admin_name, $admin_email, $pass);

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


}

?>

    <!-- Start Main content -->
    <div class="col-md-8 mx-auto main-content">
        <h4 class="p-3">الإعدادات العامة</h4>
        <div class="container">
            <div class="add-post">
                <form action="settings" method="post">
                    <div class="form-group">
                        <label for="post-author">كاتب المقالات</label>
                        <input type="text" name="post-author" id="post-author" class="form-control" value="<?php echo $author; ?>">
                    </div>
                    <button class="btn btn-custom" type="submit" name="general-settings">حفظ</button>
                </form>
            </div>
        </div>
        <br>
        <h4 class="p-3">إعدادات مدير التطبيق</h4>
        <div class="container">
            <div class="add-post">
                <form action="settings" method="post">
                    <div class="form-group">
                        <label for="admin-name">الإسم</label>
                        <input type="text" name="admin-name" id="admin-name" class="form-control" value="<?php echo $admin['user_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="admin-email">الإميل</label>
                        <input type="text" name="admin-email" id="admin-email" class="form-control" value="<?php echo $admin['user_email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="admin-password">كلمة المرور</label>
                        <input type="text" name="admin-password" id="admin-password" class="form-control" >
                    </div>
                    <button class="btn btn-custom" type="submit" name="admin-settings">حفظ</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Main content -->
    </div>

<?php include_once 'includes/templates/admin_footer.php'; ?>