<?php
session_start();
require('functions.php');

$email = $_SESSION['email'];
$edit_user_id = $_GET["id"];
$_SESSION['id'] = $_GET['id'];

$logged_user_id = get_logged_user_id($email);
$user = user_role($email);

if(!admin($user) && !is_author($edit_user_id,$logged_user_id)){
    set_flash_message('danger', "Вы не можете удалить чужой профиль, можно удалять только свой профиль!");
    redirect_to("users.php");
}else if(admin($user)){
    delete_user($edit_user_id);
    redirect_to("users.php");
    set_flash_message('danger', "Профиль успешно удален!");
}else{
    delete_user($edit_user_id);
    redirect_to("page_register.php");
    session_destroy();
}







