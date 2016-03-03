<?php session_start();
include 'base.php'; ?>
 
<?php startblock('body-cont')?> 
<?php
if (! isset ( $_SESSION ['valid'] )) {
	header ( 'Location: login.php' );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Usuario</title>
</head>
<body>
<?php
require_once 'conexao/conexao.php';

if (isset ( $_POST ['Incluir'] )) {
	$idUsuario = $_POST['idUsuario'];
	$usuario   = $_POST['usuario'];
	$senha     = $_POST['senha'];
	$lembrete  = $_POST['lembrete'];
	$idPerfil  = $_POST['idPerfil'];
	
	$usuarioArray = array (
			'idUsuario' => "$idPerfil",
			'usuario'   => "$usuario",
			'senha'     => "$senha",
			'lembrete'  => "$lembrete",
			'idPerfil'  => "$idPerfil"
	);
	
	$usuarios = array (
			$usuarioArray 
	);
	
	foreach ( $usuarios as $chave => $usuarioArray ) {
		
		$resultado = pg_insert ( $conexao, 'usuario', $usuarioArray );
		
		if ($resultado) {
			echo "<script language='javascript' type='text/javascript'>alert('Usuario incluido com sucesso!');
	     				window.location.href='selecionarUsuario.php';</script>";
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
	<form class="form-horizontal" name="frmUsuario" method="POST" action="incluirUsuario.php">
		<div class="form-group">
			<label class="col-sm-2"> ID  </label>
			<input type="text" id="idUsuario" name="idUsuario">  
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Usuario </label>
		    <input type="text" id="usuario"   name="usuario">    <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Senha </label>
		    <input type="text" id="senha"     name="senha">      <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Lembrete </label>
			<input type="text" id="lembrete"  name="lembrete">   <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Perfil </label>
		    <input type="text" id="idPerfil"  name="idPerfil">   <br>
		</div>
		          <input type="submit" name="Incluir" value="Incluir"> 
		          <a href='selecionarPerfil.php'>Voltar</a>
	</form>
	</div>
</body>
</html>
<?php endblock('body-cont')?>