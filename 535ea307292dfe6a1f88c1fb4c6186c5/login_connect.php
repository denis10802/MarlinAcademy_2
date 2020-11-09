<?php
session_start();
require("functions.php");

$email = $_POST['email'];
$pass = $_POST['password'];

if(is_logged_in($email, $email)){
    redirect_to('users.php');
} else {
    set_flash_message('danger', 'Неверный пароль или логин');
    redirect_to('page_login.php');
}




