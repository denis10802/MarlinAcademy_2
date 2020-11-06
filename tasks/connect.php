<?php
$text = $_POST['text'];
$connect = new PDO("mysql:host=localhost;dbname=datadb; charset=utf8",'root','');
$dataText = $connect ->prepare("INSERT INTO table_text(text) values (:text)");
$dataText -> execute(['text'=>$text]);
header("Location: task_9.php");