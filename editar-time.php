<?php

if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

    if(isset($_POST['edit'])) {
        $editNome = $_POST['att-nome'];
        $editSiglas = $_POST['att-siglas'];
        $edit = $mysqli->prepare("UPDATE times SET nome = ?, siglas = ? WHERE id = ?") or die($mysqli->error);
        $edit->bind_param("sss",$editNome, $editSiglas, $idSessao);
        $edit->execute();
        $mysqli->close();
        header("location: time.php?id=".$idSessao);
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
            <input type="text" name="att-apelido" class="form-control" id="att-nome" value="<?php echo $usuarioApelido ?>">
          </div>
          <div class="mb-3">
            <label for="att-contato" class="col-form-label">Atualizar Siglas</label>
            <input type="text" name="att-contato" class="form-control" id="att-siglas" maxlength="5" value="<?php echo $usuarioContato ?>">
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