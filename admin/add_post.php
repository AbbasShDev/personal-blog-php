<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="AbbasShDev @AbbasShDev">
    <!--    <link rel="icon" type="image/png" href="layout/images/favicon.svg">-->
    <!-- Fonts -->
    <link rel="stylesheet" href="layout/css/fonts/neo.ttf">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <!-- main CSS -->
    <link rel="stylesheet" href="layout/css/main.css">
    <title></title>
</head>
<body>
<!-- Start Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4>لوحة التحكم</h4>
                <ul>
                    <a href="index.php">
                        <li class="">
                            <span><i class="fas fa-tachometer-alt"></i></span>
                            <span>الرئسية</span>
                        </li>
                    </a>
                    <a href="categories">
                        <li class="active">
                            <span><i class="fas fa-tags"></i></span>
                            <span>التصنيفات</span>
                        </li>
                    </a>
                    <li class="dropdown">
                        <div class="dropdown-toggle" data-toggle="collapse" data-target="#articles-menu">
                            <span><i class="far fa-newspaper"></i></span>
                            <span>المقالات</span>
                        </div>
                        <ul class="collapse" id="articles-menu">
                            <a href="#">
                                <li>
                                    <span><i class="far fa-plus-square"></i></span>
                                    <span>مقال جديد</span>
                                </li>
                            </a>
                            <a href="#">
                                <li>
                                    <span><i class="fas fa-list"></i></span>
                                    <span>كل المقالات</span>
                                </li>
                            </a>
                        </ul>
                    </li>
                    <a href="#">
                        <li>
                            <span><i class="far fa-eye"></i></span>
                            <span>عرض الموقع</span>
                        </li>
                    </a>
                    <a href="#">
                        <li>
                            <span><i class="fas fa-trash-alt"></i></span>
                            <span>تسجيل الخروح</span>
                        </li>
                    </a>
                </ul>
            </div>
            <!-- Start Main content -->
            <div class="col-md-10 main-content">
                <h4 class="p-3">إضافة مقال</h4>
                <div class="container">
                    <div class="add-post">
                        <form action="">
                            <div class="form-group">
                                <label for="post-name">عنوان المقال</label>
                                <input type="text" name="post-name" id="post-name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="post-cat">التصنيف</label>
                                <select name="post-cat" id="post-cat" class="custom-select">
                                    <option value="">بلوجر</option>
                                    <option value="">php</option>
                                    <option value="">برمجة</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post-image">صورة المقال</label>
                                <input type="file" name="post-image" id="post-image" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <label for="post-content">نص المقال</label>
                                <textarea cols="30" rows="10" name="post-content" id="post-content" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-custom">نشر المقال</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Main content -->
        </div>
    </div>
</div>
</div>
<!-- End Content -->




<!-- Start Footer  -->
<!--<footer>-->
<!--    جميع الحقوق محفوظة &copy; 2020-->
<!--</footer>-->
<!-- End Footer  -->
<!-- jQuery js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!-- Bootstrap js -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
<!-- main js -->
<script src="layout/js/main.js"></script>
</body>
</html>
