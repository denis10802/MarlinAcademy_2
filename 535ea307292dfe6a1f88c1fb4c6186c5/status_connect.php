<?php
session_start();
require('functions.php');

$user_id = $_SESSION['id'];
$status = $_POST['status'];

set_status($status, $user_id);
redirect_to('users.php');
