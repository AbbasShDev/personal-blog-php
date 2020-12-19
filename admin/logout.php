<?php
session_start();
require_once 'includes/config/app.php';

if (isset($_SESSION['user_id'] )){

    session_destroy();

    header("location: $config[main_app_url]");
    die();
}