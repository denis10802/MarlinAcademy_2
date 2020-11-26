<?php
$text = $_POST['text'];

$pdo = new PDO('mysql:host=localhost;dbname=datadb;charset=utf8','root','');
$sql="INSERT INTO table_text(text) values (:text)";
$statement = $pdo -> prepare($sql);
$statement -> execute(['text'=>$text]);
$statement->fetchAll(PDO::FETCH_ASSOC);
header("Location: task_9.php");
