<?php
ob_start();
session_start();
$page_title = 'التصنيفات';
include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/header.php';

$categories_stat = $mysqli->query('SELECT * FROM categories');
$categories = $categories_stat->fetch_all(MYSQLI_ASSOC);
?>
<!-- Start Content  -->
<div class="content all-categories">
    <h4 class="mx-auto">
        أحدث التصنيفات
        <span></span>
    </h4>
    <div class="container">
        <ul class="row justify-content-center">
            <?php foreach ($categories as $category): ?>
            <a href="<?php echo $config['app_url'];?>category?c_id=<?php echo $category['id'];?>">
                <li class="m-2 px-2">
                    <span><i class="fas fa-tags"></i></span>
                    <span><?php echo $category['category_name'];?></span>
                </li>
            </a>
            <?php endforeach; ?>
        </ul>
</div>
<!-- End Content  -->
<?php
include_once 'includes/templates/footer.php';
?>