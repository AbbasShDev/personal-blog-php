<?php
ob_start();
session_start();
$page_title = 'الرئسية';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/admin_header.php';

$posts_num_stat = $mysqli->query('SELECT * FROM posts ORDER BY id DESC');
$posts_count = $posts_num_stat->num_rows;

$categories_num_stat = $mysqli->query('SELECT * FROM categories ORDER BY id DESC');
$categories_count = $categories_num_stat->num_rows;
?>
        <!-- Start Main content -->
        <div class="col-md-10 home-stat">
                <h4 class="p-3">الرئسية</h4>
                <div class="row">
                    <div class="col-md-6 pb-4">
                        <div class="stat bg-secondary">
                            <i class="fas fa-tags"></i>
                            <div class="info">
                                التصنيفات
                                <span><a href="categories"><?php echo $categories_count ?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="stat bg-dark">
                            <i class="far fa-newspaper"></i>
                            <div class="info">
                                المقالات
                                <span><a href="all_posts"><?php echo $posts_count ?></a></span>
                            </div>
                        </div>
                    </div>

                </div>

            <div class="row latest">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-tags"></i>
                            آخر التصنيفات المضافه
                            <span class="toggle-info float-right"><i class="fa fa-minus fa-lg"></i></span>
                        </div>
                        <ul class="latest-info list-group list-group-flush">
                            <?php
                            $categories_stat = $mysqli->query('SELECT * FROM categories ORDER BY id DESC LIMIT 5');
                            $categories = $categories_stat->fetch_all(MYSQLI_ASSOC);
                            if (!empty($categories)){
                                foreach ($categories as $category): ?>
                                    <li class="list-group-item p-2">
                                        <?php echo $category['category_name']?>
                                        <div class="float-right btns">
                                            <a href="members.php?do=Delete&userid" class="confirm btn btn-danger btn-sm">
                                                <i class="fas fa-backspace"></i>
                                                حذف
                                            </a>
                                            <a href="members.php?do=Edit&userid=" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                                تعديل
                                            </a>
                                        </div>
                                    </li>
                            <?php endforeach;}else{
                                echo '<div class="p-3">لايوجد معلومات لعرضها</div>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 pt-4 pt-md-0">
                    <div class="card">
                        <div class="card-header">
                            <i class="far fa-newspaper"></i>
                            آخر المقالات المضافه
                            <span class="toggle-info float-right"><i class="fa fa-minus fa-lg"></i></span>
                        </div>
                        <ul class="latest-info list-group list-group-flush">
                            <?php
                            $posts_stat = $mysqli->query('SELECT * FROM posts ORDER BY id DESC LIMIT 5');
                            $posts = $posts_stat->fetch_all(MYSQLI_ASSOC);
                            if (!empty($posts)){
                                foreach ($posts as $post): ?>
                                    <li class="list-group-item p-2">
                                        <?php echo $post['post_title']?>
                                        <div class="float-right btns">
                                            <a href="members.php?do=Delete&userid" class="confirm btn btn-danger btn-sm">
                                                <i class="fas fa-backspace"></i>
                                                حذف
                                            </a>
                                            <a href="members.php?do=Edit&userid=" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                                تعديل
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach;}else{
                                echo '<div class="p-3">لايوجد معلومات لعرضها</div>';
                            }
                            ?>
                        </ul>
                        </ul>

                    </div>
                </div>
            </div>

            </div>
            <!-- End Main content -->
            </div>

<?php include_once 'includes/templates/admin_footer.php'; ?>