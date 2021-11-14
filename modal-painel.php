<?php


?>

<div class="modal fade" id="cria-time" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Criação de Time</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="att-nick" class="col-form-label">Nome do time:</label>
            <input type="text" name="nome" class="form-control" placeholder="Nome do time" id="att-nome">
          </div>
          <div class="mb-3">
            <label for="att-contato" class="col-form-label">Siglas</label>
            <input type="text" name="siglas" class="form-control" placeholder="Siglas do time (Máx. 5 caracteres)" id="att-siglas" maxlength="5">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name="edit" class="btn btn-primary btn-editar">Criar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>