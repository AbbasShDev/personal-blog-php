<?php
session_start();
$pageTitle = 'تسجيل الدخول';

require_once 'includes/config/app.php';
require_once 'includes/config/database.php';

if (isset($_SESSION['user_id'] )){
    header("location: $config[app_url]");
    die();
}

$errors     = [];
$email      = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email          = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass           = mysqli_real_escape_string($mysqli, $_POST['pass']);

    if (empty($email)){array_push($errors, 'يجب ادخال بريد الكتروني');}
    if (empty($pass)){array_push($errors, 'يجب ادخال كلمة سر');}
    if (strlen($pass) < 6 ){array_push($errors, 'يجب أن يكون طول كلمة السر على الأقل 6 حروفٍ/حرفًا');}

    if (!count($errors)){

        $query = "SELECT * FROM users WHERE user_email = '$email'";

        $userExist = $mysqli->query($query);

        if (!$userExist->num_rows){
            array_push($errors, 'البيانات المدخلة غير متطابقة مع البيانات المسجلة لدينا');
        }else{

            $user_found = $userExist->fetch_assoc();

            if (password_verify($pass, $user_found['user_password'])){


                $_SESSION['user_name']  = $user_found['user_name'];
                $_SESSION['user_id']    = $user_found['user_id'];
                $_SESSION['notify_message'] = "مرحبا $user_found[user_name] ، نتمنى لك وقتاً ممتعاً";

                header("location: $config[app_url]");
                die();

            }else{
                array_push($errors, 'البيانات المدخلة غير متطابقة مع البيانات المسجلة لدينا');
            }

        }

    }

}


?>
    <!doctype html>
    <html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="هي خدمة لحفظ وتجميع المحتوى من الانترنت في مكان واحد. يمكن حفظ المقالات و الفيديوهات او اي صفحة. كما يمكن انشاء القوائم الخاصة بك واضافة المحتوى اليها. اضاف اي محتوى من الانترنت وتمتع به في اي وقت، في مكان واحد.">
        <meta name="author" content="AbbasShDev @AbbasShDev">
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
        <!-- animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <!-- main CSS -->
        <link rel="stylesheet" href="<?php echo $config['app_url']?>layout/css/main.css">
        <title><?php echo "$config[app_name] $pageTitle"?></title>
    </head>
<body>

    <div class="login-register">
        <!-- login-register -->
        <div class="container col-10 col-lg-4 login-page">
            <?php include 'includes/config/errorMessages.php'?>
            <p class="text-center font-head ">تسجيل دخول | لوحة تحكم مدونتي</p>

            <form class="sign" action="login" method="post">
                <div class="input-container"><input type="email" name="email" class="form-control mb-3" placeholder="البريد الإلكتروني" required="required"  value="<?php echo $email?>" ></div>
                <div class="input-container"><input type="password" name="pass" class="form-control mb-3" autocomplete="new-password" placeholder="كلمة المرور" required="required"></div>
                <input type="submit" class="btn btn-block" name="login" value="دخول">

            </form>

        </div>
    </div>

    <!-- Start Footer  -->
<!--    <div class="footer">-->
<!--        <div>-->
<!--            <a href="https://twitter.com/AbbasShDev" target="_blank"><i class="mr-2 p-1 fab fa-twitter"></i></a>-->
<!--            <a href="https://github.com/AbbasShDev" target="_blank"><i class="mr-2 p-1 fab fa-github "></i></a>-->
<!--            <a href="https://www.linkedin.com/in/abbas-alshaqaq-7b58221a5/" target="_blank"><i class="mr-2 p-1 fab fa-linkedin"></i></a>-->
<!--            Coded by AbbasShDev <span>2020 ©</span>-->
<!--        </div>-->
<!--    </div>-->
    <!-- End Footer  -->
    <!-- jQuery js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap js -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
    <!-- main js -->
    <script src="<?php echo $config['app_url']?>layout/js/main.js"></script>
</body>
</html>