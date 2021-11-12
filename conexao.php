<?php

include 'config.php';

$mysqli = mysqli_connect(HOST, USUARIO, SENHA, DATABASE);

if(!$mysqli) {
    die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
}