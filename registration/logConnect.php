<?php
session_start();
require ("func.php");

$logs = login($email,$pass);
if($_POST['email']) {
    foreach ($logs as $login) {
        if ($_POST['email'] == $login['email'] && $_POST['password'] == $login['password']) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            redirect_to('task_8.php');

        }else{
            set_flash_message('danger','Неверный пароль или логин');
            redirect_to('page_login.php');
        }
    }
}