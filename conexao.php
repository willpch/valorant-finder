<?php

include 'config.php';

$mysqli = new mysqli(HOST, USUARIO, SENHA, DATABASE);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}