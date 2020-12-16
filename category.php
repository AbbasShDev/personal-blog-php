<?php
ob_start();
session_start();

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';

if (isset($_GET) && isset($_GET['c_id']) && is_numeric($_GET['c_id'])){
    $category_id = intval($_GET['c_id']);

    $category_stat = $mysqli->prepare('SELECT * FROM categories WHERE id=?');
    $category_stat->bind_param('i',$category_id);
    $category_stat->execute();
    $result = $category_stat->get_result();

    if ($result->num_rows > 0){
        $category = $result->fetch_assoc();

        $page_title = $category['category_name'];
        include_once 'includes/templates/header.php'
        ?>

        <!-- Start Content  -->
        <div class="category-header">
            <h1>#<?php echo $category['category_name']; ?></h1>
        </div>
        <div class="content category-content">
            <div class="container col-12 col-sm-12 col-md-10 col-lg-8">
                <ul>
                    <?php
                    $posts_stat = $mysqli->prepare('SELECT * FROM posts WHERE post_category=? ORDER BY id DESC');
                    $posts_stat->bind_param('i',$category_id);
                    $posts_stat->execute();
                    $posts = $posts_stat->get_result()->fetch_all(MYSQLI_ASSOC);
                    foreach ($posts as $post): ?>
                        <li>
                            <a href="<?php echo $config['app_url'];?>article?p_id=<?php echo $post['id'];?>">
                                <span class="span-image">
                                    <img src="<?php echo $config['app_url'].$post['post_image'] ?>" alt="latest posts image">
                                </span>
                            </a>
                            <div class="post-info">
                                <p class="post-title">
                                    <a href="<?php echo $config['app_url'];?>article?p_id=<?php echo $post['id'];?>">
                                        <?php echo $post['post_title'] ?>
                                    </a>
                                </p>
                                <p class="post-author">
                                    <i class="fas fa-user"></i>
                                    <?php echo $post['post_author'] ?>
                                </p>
                                <p>
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo $post['post_date'] ?>
                                </p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- End Content  -->
        <?php
        include_once 'includes/templates/footer.php';
    }else{
        header("location: $config[app_url]");
        die();
    }
}else{
    header("location: $config[app_url]");
    die();
}?>