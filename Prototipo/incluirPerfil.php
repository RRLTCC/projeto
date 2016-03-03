<?php session_start(); ?>
<?php include 'base.php'?>
 
<?php
if (! isset ( $_SESSION ['valid'] )) {
	header ( 'Location: login.php' );
}
?>

<?php startblock('body-cont')?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Perfil de Usuario</title>
</head>
<body>
<?php
require_once 'conexao/conexao.php';

if (isset ( $_POST ['Incluir'] )) {
	$idPerfil = $_POST ['idPerfil'];
	$descricao = $_POST ['descricao'];
	
	$perfil = array (
			'idPerfil' => "$idPerfil",
			'descricao' => "$descricao" 
	);
	
	$perfis = array (
			$perfil 
	);
	
	foreach ( $perfis as $chave => $perfil ) {
		
		$resultado = pg_insert ( $conexao, 'perfil', $perfil );
		
		if ($resultado) {
			echo "<script language='javascript' type='text/javascript'>alert('Perfil incluido com sucesso!');
	     				window.location.href='selecionarPerfil.php';</script>";
		} else {
			echo pg_last_error ( $conexao ) . " <br />";
		}
	}
	pg_close ( $conexao );
}
?>
	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
	<div class="content">
	<form class="form-horizontal" name="frmUsuario" method="POST" action="incluirPerfil.php">
		<div class="form-group">
				<label class="col-sm-2">ID</label>
				<input type="text" id="idPerfil" name="idPerfil">
		</div>
		<div class="form-group">
				 <label class="col-sm-2">Descricao</label>
				 <input type="text" id="descricao" name="descricao">
		 </div>
		          <input type="submit" name="Incluir" value="Incluir" > 
		          <a href='selecionarPerfil.php'>Voltar</a>
	</form>
	</div>
</body>
</html>
<?php endblock('body-cont')?>