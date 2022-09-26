<?php
	session_start();
    if (!isset($_SESSION['usuario_sesion'])) {
        header('Location: index.php');
        die;
    }
	$titulo = 'Error!';
	include 'header.php';
?>
    <div id="error">
        <br><br><br>
        <h1>Ups...</h1>
        <p>Se ha producido un error con la conexión hacia la base de datos o algún servicio relacionado con el sistema, favor contacte al administrador del mismo; <a href="mailto:cmora_98@hotmail.com" target="_blank">cmora_98@hotmail.com</a></p>
        <?php //<p>Por favor, contacte al administrador del sistema.</p> ?>
        <?php //<p>Si el problema persiste, <a href="contacto.php">contactanos</a>.</p> ?>
    </div>
<?php
	include 'footer.php';