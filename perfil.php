<?php include_once 'includes/header.php' ?>

<?php
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

?>

<link rel="stylesheet" href="assets/css/perfil.css">

<div class="superior">
    <div class="foto">
        <div class="rank">
                
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php' ?>