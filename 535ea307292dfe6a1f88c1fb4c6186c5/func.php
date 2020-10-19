<?php
session_start();

function get_user_by_email($email){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection -> prepare("SELECT * FROM users WHERE email=:email");
    $query ->execute(['email'=>$email]);
    return $request = $query ->fetch();
}

function add_user($email, $pass){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection ->prepare("INSERT INTO users (email, password) VALUES (:email, :pass)");
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

function redirect_to($path){
    header("Location:$path");
}

function is_logged_in()
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $log = $connection ->prepare("SELECT * FROM users ");
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


if(!$_SESSION['email'] || !$_SESSION['password']){
    redirect_to('page_login.php');
    die();
}

$connection = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8','root','');
$cardData =$connection->prepare("SELECT * FROM users");
$cardData ->execute();
$cardData=$cardData->fetchAll();

$mail = $_SESSION['email'];
$user=$connection->query("SELECT * FROM users WHERE email ='$mail'");
$user=$user->fetch();








//function login($email, $pass){
//    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
//    $log = $connection ->prepare("SELECT * FROM users ");
//    $log ->execute(['email'=>$email, 'password'=>$pass]);
//    return $log;
//}
