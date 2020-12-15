<?php
ob_start();
session_start();
$page_title = 'الرئسية';

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/header.php'

?>

<!-- Start Content  -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <?php
                $posts_stat = $mysqli->query('SELECT posts.*, categories.category_name FROM posts INNER JOIN categories ON posts.post_category=categories.id ORDER BY id DESC');
                $posts = $posts_stat->fetch_all(MYSQLI_ASSOC);
                foreach ($posts as $post):
                ?>

                    <div class="post">
                        <div class="post-image">
                            <a href="#">
                                <img src="<?php echo $config['app_url'].$post['post_image'] ?>" alt="post image">
                            </a>
                        </div>
                        <div class="post-title">
                            <a href="#">
                                <h4><?php echo $post['post_title'] ?></h4>
                            </a>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fas fa-user"></i><?php echo $post['post_author'] ?></span>
                                <span><i class="far fa-calendar-alt"></i><?php echo $post['post_date'] ?></span>
                                <span>
                                    <i class="fas fa-tags"></i>
                                    <a href="#"><?php echo $post['category_name'] ?></a>
                                </span>
                            </p>
    <!--                        <button class="btn btn-custom">إقرأ المزيد</button>-->
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <div class="col-md-3">
                <!-- Start categories -->
                <div class="categories">
                    <h4 class="mx-auto">
                        أحدث التصنيفات
                        <span></span>
                    </h4>
                    <ul>
                        <?php
                        $categories_stat = $mysqli->query('SELECT * FROM categories ORDER BY id DESC LIMIT 5');
                        $categories = $categories_stat->fetch_all(MYSQLI_ASSOC);
                        foreach ($categories as $category): ?>
                        <a href="">
                            <li>
                                <span><i class="fas fa-tags"></i></span>
                                <span><?php echo $category['category_name']?></span>
                            </li>
                        </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- End categories -->
                <!-- Start latest-posts-->
                <div class="latest-posts">
                    <h4 class="mx-auto">
                        أحدث المنشورات
                        <span></span>
                    </h4>
                    <ul>
                        <?php
                        $last_posts_stat = $mysqli->query('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
                        $last_posts = $last_posts_stat->fetch_all(MYSQLI_ASSOC);
                        foreach ($last_posts as $last_post): ?>
                        <li>
                            <a href="">
                                <span class="span-image"><img src="<?php echo $config['app_url'].$last_post['post_image'] ?>" alt="latest posts image"></span>
                                <span><?php echo $last_post['post_title'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- End latest-posts -->
            </div>
        </div>
    </div>
</div>
<!-- End Content  -->
<?php include_once 'includes/templates/footer.php' ?>