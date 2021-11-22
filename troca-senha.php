<?php
    

    if($_POST) {
        
        $eMail = $_POST['e-mail'];
        $senhaAtual = $_POST['senhaAtual'];
        $novaSenha = $_POST['novaSenha'];
        $repNovaSenha = $_POST['repNovaSenha'];

        $senhaCrypt = password_hash($novaSenha, PASSWORD_DEFAULT);

        function UserExiste($mysqli, $eMail) {
            $selectUser = $mysqli->query("SELECT email FROM jogadores WHERE email = '$eMail';") or die ("Ouve um problema na conexão: $mysqli->error");
            $retornoSelect = $selectUser->fetch_assoc();
            if ($retornoSelect){
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaCase($novaSenha) {
            if (!ctype_upper($novaSenha) && !ctype_lower($novaSenha)) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaTamanho($novaSenha) {
            if (strlen($novaSenha) >= 8) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaNome($mysqli ,$novaSenha, $eMail) {
            $selectUsuario = $mysqli->query("SELECT usuario FROM jogadores WHERE email = '$eMail';") or die ("Ouve um problema na conexão: $mysqli->error");
            $retornoSelect = $selectUsuario->fetch_assoc();
            $user = $retornoSelect['usuario'];
            $userSub = substr($user, 0, 4);
            $parteNome = stripos($novaSenha, $userSub);
            
            if ($parteNome === false) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaSimbolos($novaSenha) {
            if (!ctype_alnum($novaSenha)) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaNumeros($novaSenha) {
            if (!ctype_digit($novaSenha) && !ctype_alpha($novaSenha) && !ctype_alnum($novaSenha)) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaAtual($mysqli, $eMail, $senhaAtual) {
            $selectSenha = $mysqli->query("SELECT senha FROM jogadores WHERE email = '$eMail';");
            $retornoSelect = $selectSenha->fetch_assoc();
            $senhaRetorno = $retornoSelect['senha'];
            $checarSenha = password_verify($senhaAtual, $senhaRetorno);
            if ($checarSenha) {
                return true;
            } else {
                return false;
            }
        }

        function ValidaSenhaAnterior($mysqli, $eMail, $novaSenha) {
            $selectSenha = $mysqli->query("SELECT senha FROM jogadores WHERE email = '$eMail';");
            $retornoSelect = $selectSenha->fetch_assoc();
            $senhaRetorno = $retornoSelect['senha'];
            $checarSenha = password_verify($novaSenha, $senhaRetorno);
            if (!$checarSenha) {
                return true;
            } else {
                return false;
            }
        }
        
        if (!ValidaSenhaAnterior($mysqli, $eMail, $novaSenha)) {
            echo "Senha nova é igual a senha antiga, escolha outra senha";
            exit();
        }

        if (!UserExiste($mysqli, $eMail)) {
            echo "E-mail não existe no banco de dados";
            exit();
        }

        if (!ValidaSenhaNome($mysqli ,$novaSenha, $eMail)) {
            echo "Senha não pode conter parte do nome do usuário";
            exit();
        }

        if (!ValidaSenhaAtual($mysqli, $eMail, $senhaAtual)) {
            echo "Senha atual inválida";
            exit();
        }

        if ($novaSenha == $repNovaSenha) {
            if (ValidaSenhaCase($novaSenha) && ValidaSenhaTamanho($novaSenha) &&
            ValidaSenhaSimbolos($novaSenha, $eMail) && ValidaSenhaNumeros($novaSenha, $eMail)) {
                $edit = $mysqli->prepare("UPDATE jogadores SET senha = ? WHERE email = ?") or die($mysqli->error);
                $edit->bind_param("ss", $senhaCrypt, $eMail);
                $edit->execute();
                $_SESSION['tentativa'] = 1;
                header('Location: login.php');
            } else {
                echo "Senha inválida";
            }
        } else {
            echo "Senhas diferentes";
        }
    }

?>

<div class="modal fade" id="troca-senha" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Trocar senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="e-mail" class="col-form-label">E-mail</label>
            <input type="text" name="e-mail" class="form-control" placeholder="E-mail" id="e-mail">
          </div>
          <div class="mb-3">
            <label for="senha-atual" class="col-form-label">Senha atual</label>
            <input type="password" name="senhaAtual" class="form-control" placeholder="Senha atual" id="senha-atual">
          </div>
          <div class="mb-3">
            <label for="nova-senha" class="col-form-label">Nova senha</label>
            <input type="password" name="novaSenha" class="form-control" placeholder="Deve conter maiúsculas, minúsculas, números e símbolos" id="nova-senha" maxlength="25">
          </div>
          <div class="mb-3">
            <label for="rep-senha" class="col-form-label">Repetir senha</label>
            <input type="password" name="repNovaSenha" class="form-control" placeholder="Repetir nova senha" id="rep-senha" maxlength="25">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="senhas" class="btn btn-primary btn-editar">Atualizar senha</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>