<?php
require("functions.php");


$email = $_POST['email'];
$password = $_POST['password'];
$image = $_FILES['file']['name'];
$username = $_POST['username'];
$job_title= $_POST['job_title'];
$phone= $_POST['tel'];
$address= $_POST['address'];
$telegram= $_POST['telegram'];
$instagram= $_POST['instagram'];
$vk= $_POST['vk'];
$status = $_POST['status'];




addUser($email,$password);
$user_id = addUser($email,$password);
upload_avatar($image, $user_id);
edit($username, $phone, $job_title, $address, $user_id);
add_social_links($telegram,$instagram,$vk,$user_id);
set_status($status,$user_id);

redirect_to("create_user.php");


