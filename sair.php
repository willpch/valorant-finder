<?php

session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php");
?>

<h2>Redirecionando, aguarde...</h2>