<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Find or create your Valorant dream team!" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.0/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <link rel="shortcut icon" href="assets/img/vf-icon.webp" type="image/x-icon">

    <title>Valorant Finder</title>

</head>

<body>
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home">
                    <img src="assets/img/vf-icon.webp" alt="Valorant Finder Logo" width="40" height="40"> Valorant<span>Finder</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Crie seu time</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar times/jogadores" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Buscar</button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-login" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if(isset($_SESSION['usuario'])) : ?>
                                <?php echo ucfirst($_SESSION['usuario']) ?>
                            <?php else :?>
                                Logar
                            <?php endif ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li class="nav-item" dropdown>
                                <a class="dropdown-item" href="<?php if(!isset($_SESSION['usuario'])) {echo 'login.php';} else {echo 'perfil.php';} ?>">
                                    <?php if(isset($_SESSION['usuario'])) : ?>
                                        Perfil
                                    <?php else :?>
                                        Logar
                                    <?php endif ?>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php if(!isset($_SESSION['usuario'])) {echo 'criar-conta.php';} else {echo 'sair.php';} ?>">
                                    <?php if(isset($_SESSION['usuario'])) : ?>
                                        Sair
                                    <?php else :?>
                                        Criar Conta
                                    <?php endif ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container container-fluid">