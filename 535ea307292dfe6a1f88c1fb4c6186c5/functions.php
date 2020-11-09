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

function is_logged_in($email, $pass)
{

    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $log = $connection ->prepare("SELECT * FROM creat_user ");
    $log ->execute(['email'=>$email, 'password'=>$pass]);
        foreach ($log as $login) {
            if ($_POST['email'] == $login['email'] && $_POST['password'] == $login['password']) {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $ps = $_SESSION['password'];
                $em = $_SESSION['email'];
                return [$ps,$em];

            }
        }

}

function data_validation($email, $pass){
    if($email || $pass){
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

function is_author($user_data,$edit_user_id,$logged_user_id)
{
    if ($user_data['role'] == 'admin') {
        if ($edit_user_id > $logged_user_id || $edit_user_id < $logged_user_id) {
            redirect_to("users.php");
            set_flash_message('danger',"Вы не можете редактировать чужой профиль, можно редактировать только свой профиль!");
        }
    }

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

function get_admin_by_email($emailAdmin){
    $connection = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8','root','');
    $user = $connection->query("SELECT * FROM creat_user WHERE email ='$emailAdmin'");
    $user = $user->fetch();
    return $user;
}

function is_admin($userAdmin)
{
   return $userAdmin['role'] == 'admin';
}

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



