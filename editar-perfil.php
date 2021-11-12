<?php
    if(!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    if(isset($_FILES['foto'])) {
        $foto = $_FILES['foto'];
        if($foto['size'] > 5100000)
            die("Foto muito grande. Max: 5MB");
                
        if($foto['error'])
            die("Falha ao enviar foto.");
        
        $pastaUser = "upload/user_img/";
        $nomeFoto = $foto['name'];
        $novoNomeFoto = uniqid();
        $extensao = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != "jpeg" && $extensao != "png")
            die("Tipo de foto não aceita, somente .jpg, .jpeg ou .png!");

        $path = $pastaUser . $novoNomeFoto . "." . $extensao;

        $fotoSucesso = move_uploaded_file($foto['tmp_name'], $path);

        if($fotoSucesso) {
            include 'exclui-foto.php';
            $mysqli->query("UPDATE jogadores SET imagem = '$path' WHERE usuario = '{$_SESSION['usuario']}'") or die($mysqli->error);
            $mysqli->close();
            header("location: perfil.php?id=".$idSessao);
        } else {
            echo "Falha ao enviar foto";
        }
        
    }

    if(isset($_POST['edit'])) {
        $editApelido = $_POST['att-apelido'];
        $editContato = $_POST['att-contato'];
        $editBio = $_POST['att-bio'];
        $edit = $mysqli->prepare("UPDATE jogadores SET apelido = ?, contato = ?, bio = ? WHERE id = ?") or die($mysqli->error);
        $edit->bind_param("ssss", $editApelido, $editContato, $editBio, $idSessao);
        $edit->execute();
        $mysqli->close();
        header("location: perfil.php?id=".$idSessao);
    }

?>

<div class="modal fade" id="foto-edit" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Atualizar foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="att-foto" class="form-label">Tamanho máx. 5MB - JPG ou PNG.</label>
                <input class="form-control" name="foto" type="file" id="att-foto">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="enviar" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="perfil-edit" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            <label for="att-nick" class="col-form-label">Atualizar apelido (nick):</label>
            <input type="text" name="att-apelido" class="form-control" id="att-nick" value="<?php echo $usuarioApelido ?>">
          </div>
          <div class="mb-3">
            <label for="att-contato" class="col-form-label">Atualizar contato:</label>
            <input type="text" name="att-contato" class="form-control" id="att-contato" value="<?php echo $usuarioContato ?>">
          </div>
          <div class="mb-3">
            <label for="att-bio" class="col-form-label">Atualizar bio:</label>
            <textarea name="att-bio" rows="3" class="form-control" id="att-bio"><?php echo $usuarioBio ?></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name="edit" class="btn btn-primary btn-editar">Atualizar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
