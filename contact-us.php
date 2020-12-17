<?php
ob_start();
session_start();
$page_title = 'التصنيفات';
include_once 'includes/config/app.php';
include_once 'includes/config/database.php';
include_once 'includes/templates/header.php';


function filterString($filed){
    $filed = filter_var(trim($filed), FILTER_SANITIZE_STRING);

    if (empty($filed)){
        return false;
    }else {
        return $filed;
    }
}

function filterEmail($filed){
    $filed = filter_var(trim($filed), FILTER_SANITIZE_EMAIL);

    if (filter_var(trim($filed), FILTER_VALIDATE_EMAIL)){
        return $filed;
    }else {
        return false;
    }
}
$name = $email = $message = '';
$nameError = $emailError = $messageError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){



    $name = filterString($_POST['name']);

    if (!$name) {
        $_SESSION['contact_form']['name'] = '';
        $nameError = 'يجب كتابة اسم' ;
    }else{
        $_SESSION['contact_form']['name'] = $name;
    }

    $email = filterEmail($_POST['email']);

    if (!$email) {
        $_SESSION['contact_form']['email'] = '';
        $emailError = 'ايميل غير صالح';
    }else{
        $_SESSION['contact_form']['email'] = $email;
    }

    $message = filterString($_POST['message']);

    if (!$message) {
        $_SESSION['contact_form']['message'] = '';
        $messageError = 'يجب كتابة رسالة' ;
    }else {
        $_SESSION['contact_form']['message'] = $message;
    }

    if (!$nameError && !$emailError && !$messageError){


        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UFT-8' . "\r\n";
        $headers .= 'From: '.$email."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $messageHtml = '<html><body>';
        $messageHtml .= "<h4 style='color: #1b262c'>$name</h4>";
        $messageHtml .= "<p style='color: #3F64B5'>$message</p>";
        $messageHtml .= '</body></html>';

        if (mail('abbas20alzaeem@gmail.com','رسالة من مدونتي', $messageHtml, $headers )){
            unset($_SESSION['contact_form']);
            echo "<script>alert('شكرا تم ارسال الرسالة')</script>";
        }else{
            echo "<script>alert('حدث خطأ أثناء إرسال الرسالة')</script>";
        }

    }

}

?>
    <!-- Start Content  -->
    <div class="content about ">
        <h4 class="mx-auto">
            تواصل معنا
            <span></span>
        </h4>
    <!-- Start contact -->
    <div id="contact" class="section contact">
        <div class="container col-10 col-md-8 col-lg-6 mt-5 mx-auto p-4">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control <?php if(!empty($nameError)){ echo 'border-danger input-error'; } ?>" name="name" value="<?php if (isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name']?>" placeholder="إسمك...">
                    <span class="text-danger"><?php echo $nameError?></span>
                </div>
                <div class="form-group">
                    <label for="email">الإيميل</label>
                    <input type="email" class="form-control <?php if(!empty($emailError)){ echo 'border-danger input-error'; } ?>" name="email" value="<?php if (isset($_SESSION['contact_form']['email'])) echo $_SESSION['contact_form']['email']?>" placeholder="إيميلك...">
                    <span class="text-danger"><?php echo $emailError?></span>
                </div>
                <div class="form-group">
                    <label for="message">الرسالة</label>
                    <textarea class="form-control <?php if(!empty($messageError)){ echo 'border-danger input-error'; } ?>" name="message" placeholder="رسالتك..."><?php if (isset($_SESSION['contact_form']['message'])) echo $_SESSION['contact_form']['message']?></textarea>
                    <span class="text-danger"><?php echo $messageError?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn p-0" id="Send Message" value="إرسال الرسالة">
                </div>
            </form>
        </div>
    </div>
    <!-- End contact -->
        <!-- End Content  -->
<?php
include_once 'includes/templates/footer.php';
?>