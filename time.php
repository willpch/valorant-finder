<?php
    include_once 'includes/header.php';
    include_once 'conexao.php';

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
    }

    $uid = $_GET['id'];

    $select = "SELECT * FROM times WHERE id = '{$uid}'";
    $exec = mysqli_query($mysqli, $select);
    $linha = mysqli_fetch_assoc($exec);

    $timeId = $linha['id'];
    $timeNome = $linha['nome'];
    $timeSiglas = $linha['siglas'];
    $timeData = $linha['data_criacao'];
    $timeFoto = $linha['logo_time'];

    $selectJogadoresTime = $mysqli->query("SELECT id, usuario, apelido, imagem 
    FROM jogadores 
    JOIN times_jogadores
    WHERE jogadores.id = times_jogadores.id_jogador AND times_jogadores.id_time = '$uid';") ;

    $VerificaAdm = $mysqli->query("SELECT administrador 
    FROM times_jogadores 
    WHERE id_jogador = '$idSessao' AND id_time = '$uid';") or die($mysqli->error);
    $adm = $VerificaAdm->fetch_assoc();
    $jogadoresTime = $selectJogadoresTime->fetch_assoc();

    if($timeId != $uid) {
        header('Location: 404.php');
    }

    if(!isset($uid)) {
        header('Location: 404.php');
    }
    
?>

<link rel="stylesheet" href="assets/css/perfil.css">
<link rel="stylesheet" href="assets/css/time.css">

<div class="img-fluid img-thumbnail superior">
    <div class="foto">
        
    </div>
</div>

<div class="container-fluid">
    <div class="row gx-2 gy-2 mt">
        <div class="col-lg-4">
            <div>
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="<?php echo $timeFoto == NULL ? "assets/img/default_team_avatar.png" : $timeFoto;?>" alt="Foto time">
                </figure>
                <div class="inline">  
                    <p class="user-name"><?php echo $timeNome ?></p>
                    <p class="user-nick"><?php echo strtoupper($timeSiglas) ?> (Equipe)</p>
                </div>
            </div>
            <div>
            <?php if ($adm) { ?>
                <?php if ($adm['administrador'] == true) { ?>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#time-edit">Editar Time</button>
                    <button class="btn btn-success btn-edit-foto" data-bs-toggle="modal" data-bs-target="#foto-edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>&nbsp;Foto</button>
                    <button class="btn btn-success btn-edit-foto" data-bs-toggle="modal" data-bs-target="#time-edit">Gerenciar</button>
                <?php } ;?>
            <?php } ;?>
            </div>
        </div>
        <div class="col-md-8 d-flex flex-row-reverse">
            <?php foreach ($selectJogadoresTime as $jogador) { ?>
                
            <div class="card card-x text-center">
                <img class="img-card" src="<?php echo $jogador['imagem'] == NULL ? "assets/img/default-avatar.jpg" : $jogador['imagem'];?>" class="card-img-top" alt="Card do Integrante">
                <div class="card-body">
                    <a class="link-geral" href="<?php echo "perfil.php?id=".$jogador['id'] ?>"><?php echo ucfirst($jogador['usuario']) ?></a>
                    <p class="card-text"><?php echo $jogador['apelido'] ?></p>
                </div>
            </div>
            <?php }; ?>
        </div>
    </div>
</div>

<div class="clear"></div>

<?php
    include 'editar-time.php';
    include 'includes/footer.php'
?>