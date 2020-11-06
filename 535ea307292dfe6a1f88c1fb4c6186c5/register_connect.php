<?php
session_start();
require("functions.php");
$email = $_POST['email'];
$pass = $_POST['password'];


$userReg = get_user_by_email($email);

if(!empty($userReg)){
    set_flash_message('danger',"<strong>Уведомление!</strong> эл. адрес уже занят другим пользователем.");
    redirect_to('page_register.php');
    die();
}

add_user($email, $pass);
set_flash_message('success',"Регистрация успешна!");
redirect_to('page_login.php');



















