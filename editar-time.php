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
        
        $pastaUser = "upload/team_img/";
        $nomeFoto = $foto['name'];
        $novoNomeFoto = uniqid();
        $extensao = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != "jpeg" && $extensao != "png")
            die("Tipo de foto não aceita, somente .jpg, .jpeg ou .png!");

        $path = $pastaUser . $novoNomeFoto . "." . $extensao;

        $fotoSucesso = move_uploaded_file($foto['tmp_name'], $path);

        if($fotoSucesso) {
            include 'exclui-foto.php';
            $mysqli->query("UPDATE times SET logo_time = '$path' WHERE id = '$timeId'") or die($mysqli->error);
            $mysqli->close();
            header("location: time.php?id=".$timeId);
        } else {
            echo "Falha ao enviar foto";
        }
        
    }

    if(isset($_POST['edit'])) {
        $editNome = $_POST['att-nome'];
        $editSiglas = $_POST['att-siglas'];
        $edit = $mysqli->prepare("UPDATE times SET nome = ?, siglas = ? WHERE id = ?") or die($mysqli->error);
        $edit->bind_param("sss",$editNome, $editSiglas, $timeId);
        $edit->execute();
        $mysqli->close();
        header("location: time.php?id=".$timeId);
    }
?>

<div class="modal fade" id="time-edit" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Editar Time</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            <label for="att-nick" class="col-form-label">Atualizar nome do time:</label>
            <input type="text" name="att-nome" class="form-control" id="att-nome" value="<?php echo $timeNome ?>">
          </div>
          <div class="mb-3">
            <label for="att-contato" class="col-form-label">Atualizar Siglas</label>
            <input type="text" name="att-siglas" class="form-control" id="att-siglas" maxlength="5" value="<?php echo $timeSiglas ?>">
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

<div class="modal fade" id="gerencia-time" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Gerenciar time</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            aaaaaa
          </div>
          <div class="mb-3">
            
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