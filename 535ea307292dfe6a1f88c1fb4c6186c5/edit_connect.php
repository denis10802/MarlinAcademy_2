<?php
session_start();
require('functions.php');

$email = $_SESSION['email'];
$username = $_POST['username'];
$job_title= $_POST['job_title'];
$phone= $_POST['tel'];
$address= $_POST['address'];
$id = $_SESSION['id'];

$change_user = edit_info($username,$phone, $job_title, $address, $id);

if(!empty($change_user)){
    set_flash_message('success',"Профиль успешно обновлен");
}

redirect_to("users.php");
