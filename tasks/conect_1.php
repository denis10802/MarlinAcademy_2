<?php
session_start();
$text = $_POST['text'];
$connect = new PDO("mysql:host=localhost;dbname=datadb; charset=utf8",'root','');

$dataText = $connect->prepare("SELECT * FROM table_text WHERE text=:text");
$dataText -> execute(['text'=>$text]);
$task = $dataText ->fetch();

if(!empty($task)){
    $messages = "You should check in on some of those fields below.";
    $_SESSION['danger'] = $messages;
    header("Location: task_10.php");
    die();
}

$dataText = $connect ->prepare("INSERT INTO table_text(text) values (:text)");
$dataText -> execute(['text'=>$text]);
$messages = "You should check in on some of those fields below.";
$_SESSION['success'] = $messages;
header("Location: task_10.php");
