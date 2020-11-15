<?php
session_start();

function get_user_by_email($email){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection -> prepare("SELECT * FROM creat_user WHERE email=:email");
    $query ->execute(['email'=>$email]);
    return $request = $query ->fetch();
}

function add_user($email, $pass){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection ->prepare("INSERT INTO creat_user (email, password) VALUES (:email, :pass)");
    $query ->execute(
        [
            'email'=>$email,
            'pass'=>$pass
        ]);
}

function set_flash_message($name,$message){
    $_SESSION[$name] = $message;
}

function display_flash_message($name){

        if (isset($_SESSION[$name])){
            echo "<div class=\"alert alert-{$name}\">{$_SESSION[$name]}</div>";
            unset($_SESSION[$name]);
        }
    }

function is_logged_in($email, $pass){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $log = $connection ->prepare("SELECT * FROM creat_user WHERE email = :email");
    $log ->execute(['email'=> $email]);
    $log = $log ->fetchAll();
    foreach ($log as $login) {
        if ($email == $login['email']) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $pass;
            return true;
        }

    }
}

function data_validation($email){
    if(!$email){
        redirect_to('page_login.php');
        die();
    }
}

function users_data(){
    $connection = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8','root','');
    $cardData = $connection->prepare("SELECT * FROM creat_user");
    $cardData ->execute();
    return $cardData = $cardData->fetchAll();
}

function get_user_by_id($edit_user_id){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection -> prepare("SELECT * FROM creat_user WHERE id = :user_id");
    $query ->execute([
        'user_id'=>$edit_user_id
    ]);
    return $request = $query ->fetch();
}

function is_author($edit_user_id,$logged_user_id)
{
    return $edit_user_id == $logged_user_id;

}

function edit_info($username,$phone, $job_title, $address, $id){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');
    $query = $connection->prepare("UPDATE creat_user SET username = :username, tel = :tel, job_title = :job_title, address = :address WHERE id = :user_id");
    $query ->execute([
        'username'=>$username,
        'tel'=>$phone,
        'job_title'=>$job_title,
        'address'=>$address,
        'user_id'=> $id
    ]);
    return $id;
}

//функции для админа

function is_admin($user)
{
   return $user['role'] == 'admin';
}// для users.php

function admin($user){
    return $user == 'admin';
} // для редактирования пользователя

function addUser($email, $password)
{
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');
    $query = $connection->prepare("INSERT INTO creat_user (email, password) VALUES (:email, :pass)");
    $query->execute(
        [
            'email' => $email,
            'pass' => $password
        ]);

    $user_id = $connection->lastInsertId();
    return $user_id;
}

function upload_avatar($image,$user_id)
{

    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileName = $image;
    $fileDestination = 'uploads/'.$fileName;
    move_uploaded_file($fileTmpName,$fileDestination);
    $query = $connection ->prepare("UPDATE creat_user SET img = :fileName WHERE id = :user_id");
    $query->execute([
        'fileName'=>$fileName,
        'user_id'=>$user_id
    ]);
}

function edit($username, $phone, $job_title, $address, $user_id)
{
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');
    $query = $connection->prepare("UPDATE creat_user SET username = :username, tel = :tel, job_title = :job_title, address = :address WHERE id = :user_id");
    $query ->execute([
        'username'=>$username,
        'tel'=>$phone,
        'job_title'=>$job_title,
        'address'=>$address,
        'user_id'=>$user_id
    ]);
}

function add_social_links($telegram,$instagram,$vk,$user_id)
{
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');
    $query = $connection->prepare("UPDATE creat_user SET telegram = :telegram, instagram = :instagram, vk = :vk WHERE id = :user_id");
    $query ->execute([
        'telegram'=>$telegram,
        'instagram'=>$instagram,
        'vk'=>$vk,
        'user_id'=>$user_id
    ]);
}

function set_status($status, $user_id){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8", 'root', '');

    $query = $connection->prepare("UPDATE creat_user SET status = :status WHERE id = :user_id");
    $query ->execute([
        'status'=>$status,
        'user_id'=>$user_id
    ]);
}

function redirect_to($path){
    header("Location:$path");
}

 //profile

function user_info($user_id)
{
    $connection = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8', 'root', '');
    $cardData = $connection->prepare("SELECT * FROM creat_user WHERE id = :user_id");
    $cardData->execute(['user_id'=>$user_id]);
    return $cardData = $cardData->fetch();
}

function user_id($email){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $user_id = $connection->prepare("SELECT id FROM creat_user WHERE email= :email");
    $user_id -> execute(['email'=>$email]);
    return $user_id = $user_id->fetchColumn();
}

function edit_credentials($user_id, $email, $pass){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $connection ->query("UPDATE creat_user SET email = '$email',password = '$pass' WHERE id = '$user_id' ");
}