<?php

if(isset($idSessao))
    $fotoAntiga = $usuarioFoto;
    unlink($fotoAntiga);
?>