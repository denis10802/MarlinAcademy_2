<?php
session_start();
$text = $_POST['text'];
$pdo = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8','root','');

$sql="SELECT * FROM table_text WHERE text=:text";
$statement = $pdo -> prepare($sql);
$statement -> execute(['text'=>$text]);
$task=$statement->fetch(PDO::FETCH_ASSOC);


if(!empty($task)){
    $messages = "Введеная запись уже существуют в таблице!";
    $_SESSION['danger'] = $messages;
    header("Location: task_10.php");
    die();
}


$sql="INSERT INTO table_text(text) values (:text)";
$statement = $pdo -> prepare($sql);
$statement -> execute(['text'=>$text]);

$messages = "Введеная запись добавлена в таблицу!";
$_SESSION['success'] = $messages;

header("Location: task_10.php");




