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

<!-- Start navbar  -->
<nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <div class="container">
        <a href="<?php echo $config['app_url'];?>" class="navbar-brand">مدونتي</a>
        <button class="navbar-toggler border-0" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo $config['app_url'];?>about" class="nav-link">عن المدونة</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $config['app_url'];?>categories" class="nav-link">التصنيفات</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $config['app_url'];?>contact-us" class="nav-link">تواصل معنا</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End navbar  -->