<?php
session_start();
require("func.php");

if(is_logged_in()){
    redirect_to('users.php');
} else {
    set_flash_message('danger', 'Неверный пароль или логин');
    redirect_to('page_login.php');
}




