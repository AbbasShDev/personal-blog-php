<?php
ob_start();
session_start();

include_once 'includes/config/app.php';
include_once 'includes/config/database.php';

if (isset($_GET) && isset($_GET['p_id']) && is_numeric($_GET['p_id'])){
    $post_id = intval($_GET['p_id']);

    $post_stat = $mysqli->prepare('SELECT posts.*, categories.category_name FROM posts INNER JOIN categories ON posts.post_category=categories.id WHERE posts.id=?');
    $post_stat->bind_param('i',$post_id);
    $post_stat->execute();
    $result = $post_stat->get_result();

    if ($result->num_rows > 0){
        $post = $result->fetch_assoc();

        $page_title = $post['post_title'];
        include_once 'includes/templates/header.php'
        ?>

        <!-- Start Content  -->
        <div class="content article-content">
            <div class="container col-12 col-md-9">
                <div class="article">
                    <p class="text-left article-info"><?php echo $post['post_date'] ?> /  <a href="<?php echo $config['app_url'];?>category?c_id=<?php echo $post['post_category'];?>"">#<?php echo $post['category_name'] ?></a></p>
                    <h1 class="text-left article-title"><?php echo $post['post_title'] ?></h1>
                    <p class="text-left article-author"><i class="fas fa-user"></i> <?php echo $post['post_author'] ?></p>
                    <div class="article-image">
                            <img src="<?php echo $config['app_url'].$post['post_image'] ?>" alt="post image">
                    </div>

                    <div class="container article-content col-12 col-md-10">
                        <?php echo $post['post_content'] ?>
                    </div>
                </div>

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