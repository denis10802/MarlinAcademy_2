<?php
session_start();
require ("func.php");
$email = $_POST['email'];
$pass = $_POST['password'];
$message = $_SESSION['danger'];
$message = $_SESSION['success'];


get_user_by_email($email);

set_flash_message($message);
if(!empty(get_user_by_email($email))){
    set_flash_message("Уведомление!Этот эл. адрес уже занят другим пользователем.");
    header("location:page_register.php");
    die();
}

add_user($email, $pass);
set_flash_message("Регистрация успешна!");
header("location:page_login.php");





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




