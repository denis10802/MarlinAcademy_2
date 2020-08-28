<?php

/*function sanitarString($var){
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripcslashes($var);
    return $var;
}*/



function get_user_by_email($email){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection -> prepare("SELECT * FROM registration WHERE email=:email");
    $query ->execute(['email'=>$email]);
    return $request = $query ->fetch();
}

function add_user($email, $pass){
    $connection = new PDO("mysql:host=localhost;dbname=datadb;charset=utf8",'root','');
    $query = $connection ->prepare("INSERT INTO registration (email, password) VALUES (:email, :pass)");
    return $query ->execute(
        [
            'email'=>$email,
            'pass'=>$pass
        ]
    );
}

function set_flash_message($message){
    $_SESSION['danger'] = $message;
    $_SESSION['success'] = $message;
        return $message;
}






