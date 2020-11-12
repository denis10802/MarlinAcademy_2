<?php
session_start();
require("functions.php");

$email = $_POST['email'];
$pass = $_POST['password'];
$user_id = $_SESSION['id'];
$user_email = $_SESSION['email'];

$connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
$query = $connection ->query("SELECT email FROM creat_user");
$query = $query ->fetchAll();


if(isset($email)){
    if($email != $user_email){
        edit_credentials($user_id, $email, $pass);
        $_SESSION['email'] = $email;
        set_flash_message('success', 'Профиль успешно обновлен');
        redirect_to("page_profile.php");
    }
    foreach ($query as $item){
        if($email == $item['email']){
            set_flash_message('danger', 'Введёный email уже существует, либо используется вами');
            $_SESSION['email'] = $user_email;
            $user_url = "security.php?id=$user_id";
            redirect_to("$user_url");

        }
    }
}




