<?php
session_start();
require("functions.php");

$user_id = $_SESSION['id'];
$image = $_FILES['file']['name'];
$default_img ='no_avatar';

if(isset($_POST['submit'])) {
    upload_avatar($image, $user_id);
    $img = has_image($user_id);
    if ($default_img != $img) {
        set_flash_message('success', "Профиль успешно обновлен");
        redirect_to("page_profile.php");
    } else {
        $user_url = "media.php?id=$user_id";
        redirect_to("$user_url");
        set_flash_message('warning', "Загрузите свою фотографию");
    }

}






