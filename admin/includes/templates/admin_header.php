<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="AbbasShDev @AbbasShDev">
    <!--    <link rel="icon" type="image/png" href="layout/images/favicon.svg">-->
    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo $config['app_url'];?>layout/css/fonts/neo.ttf">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <!-- main CSS -->
    <link rel="stylesheet" href="<?php echo $config['app_url'];?>layout/css/main.css">
    <title><?php echo $config['app_name'].$page_title; ?></title>
</head>
<body>
<!-- Start Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4>لوحة التحكم</h4>
                <ul>
                    <a href="<?php echo $config['app_url'];?>">
                        <li class="<?php if ($page_title == 'الرئسية') {echo 'active';}else{echo '';} ?>">
                            <span><i class="fas fa-tachometer-alt"></i></span>
                            <span>الرئسية</span>
                        </li>
                    </a>
                    <a href="categories">
                        <li class="<?php if ($page_title == 'التصنيفات') {echo 'active';}else{echo '';} ?>">
                            <span><i class="fas fa-tags"></i></span>
                            <span>التصنيفات</span>
                        </li>
                    </a>
                    <li class="dropdown">
                        <div class="dropdown-toggle" data-toggle="collapse" data-target="#articles-menu">
                            <span><i class="far fa-newspaper"></i></span>
                            <span>المقالات</span>
                        </div>
                        <ul class="collapse <?php if ($page_title == 'إضافة مقال' || $page_title == 'كل المقالات') {echo 'show';}else{echo '';} ?>" id="articles-menu">
                            <a href="add_post">
                                <li class="<?php if ($page_title == 'إضافة مقال') {echo 'active';}else{echo '';} ?>">
                                    <span><i class="far fa-plus-square"></i></span>
                                    <span>مقال جديد</span>
                                </li>
                            </a>
                            <a href="all_posts">
                                <li class="<?php if ($page_title == 'كل المقالات') {echo 'active';}else{echo '';} ?>">
                                    <span><i class="fas fa-list"></i></span>
                                    <span>كل المقالات</span>
                                </li>
                            </a>
                        </ul>
                    </li>
                    <a href="<?php echo $config['main_app_url']?>">
                        <li class="">
                            <span><i class="far fa-eye"></i></span>
                            <span>عرض الموقع</span>
                        </li>
                    </a>
                    <a href="<?php echo $config['app_url']?>settings">
                        <li class="<?php if ($page_title == 'الإعدادات') {echo 'active';}else{echo '';} ?>">
                            <span><i class="fas fa-cog"></i></span>
                            <span>الإعدادات</span>
                        </li>
                    </a>
                    <a href="#">
                        <li class="">
                            <span><i class="fas fa-trash-alt"></i></span>
                            <span>تسجيل الخروح</span>
                        </li>
                    </a>
                </ul>
            </div>

<?php if (isset($_SESSION['notify_message'])) {?>
    <!-- Start notification message -->
    <div class="notify-message">
        <?php echo $_SESSION['notify_message'];?>
    </div>
    <!-- End notification message -->
<?php }
unset($_SESSION['notify_message']); ?>
<?php if (isset($_SESSION['error_message'])) {?>
    <!-- Start error message -->
    <div class="notify-message bg-danger">
        <?php echo $_SESSION['error_message'];?>
    </div>
    <!-- End error message -->
<?php }
unset($_SESSION['error_message']); ?>