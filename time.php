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
    WHERE jogadores.id = times_jogadores.id_jogador AND times_jogadores.id_time = '$uid';") or die($mysqli->error);

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
        <div class="col-md-4">
            <div>
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="assets/img/default_team_avatar.png" alt="Foto time">
                </figure>
                <div class="inline">  
                    <p class="user-name"><?php echo $timeNome ?></p>
                    <p class="user-nick"><?php echo strtoupper($timeSiglas) ?> (Equipe)</p>
                </div>
            </div>
            <div>
            
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#time-edit">Editar Time</button>
            
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
            <?php } ?>
        </div>
    </div>
</div>

<div class="clear"></div>

<?php
    $mysqli->close();
    include 'editar-time.php';
    include 'includes/footer.php'
?>