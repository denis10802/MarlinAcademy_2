<?php
session_start();
require ("func.php");
$email = $_POST['email'];
$pass = $_POST['password'];



get_user_by_email($email);

if(!empty(get_user_by_email($email))){
    set_flash_message('danger',"<strong>Уведомление!</strong> эл. адрес уже занят другим пользователем.");
    redirect_to('page_register.php');
    die();
}

add_user($email, $pass);
set_flash_message('success',"Регистрация успешна!");
redirect_to('page_login.php');





/*$connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');

$query = $connection -> prepare("SELECT * FROM registration WHERE email=:email");
$query ->execute(['email'=>$email]);
$request = $query ->fetch();
if(!empty($request)){
    $message = "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.";
    $_SESSION['danger'] = $message;
    header("location:page_register.php");
    die();
}


$query = $connection ->prepare("INSERT INTO registration (email, password) VALUES (:email, :pass)");
$query ->execute(
    [
        'email'=>$email,
        'pass'=>$pass
    ]
);
$message = " Регистрация успешна!";
$_SESSION['success'] = $message;
header("location:page_login.php");*/




