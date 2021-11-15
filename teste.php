<?php

include 'includes/header.php';
include_once 'conexao.php';

$timeNome = "aaaa";
$timeSiglas = "bbbb";

$novoTime = $novoTime = $mysqli->query("SELECT * FROM times WHERE nome = '$timeNome', siglas = '$timeSiglas';");
            $timeAtual = $novoTime->fetch_assoc();
            $idTime = $timeAtual['id'];
            $mysqli->query("INSERT INTO times_jogadores (id_jogador, id_time, administrador) VALUES ('$idSessao', $idTime, TRUE)");


            echo $idTime;