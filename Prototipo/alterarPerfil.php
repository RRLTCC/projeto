<?php session_start();include 'base.php'; ?>
<?php startblock('body-cont')?>
 
<?php
if (! isset ( $_SESSION ['valid'] )) {
	header ( 'Location: login.php' );
}
?>
<?php
	require_once 'conexao/conexao.php';
	
	$idPerfil  = $_GET['idPerfil'];

	$query     = "SELECT idPerfil FROM perfil WHERE idPerfil='$idPerfil'";
	$resultado = pg_query($conexao, $query);

	while ($res = pg_fetch_array($resultado)){
		$descricao = $res['descricao'];
	}
?> 
<?php
	
	if (isset ( $_POST ['alterar'] )) {
		$idPerfil  = $_POST['idPerfil'];
		$descricao = $_POST['descricao'];
		
		$perfilArray = array(
				'descricao' => "$descricao"
		);
			
		$condicao = array(
				'idPerfil' => "$idPerfil"
		);
			
		$perfis= array($perfilArray);
		
		foreach ($perfis as $key => $perfilArray) {
				
			$resultado = pg_update($conexao, 'perfil', $perfilArray, $condicao);
				
			if ($resultado) {
				echo "<script language='javascript' type='text/javascript'>alert('Perfil alterado com sucesso!');
				   				window.location.href='selecionarPerfil.php';</script>";
			} else {
				echo pg_last_error($conexao);
			}
			pg_close($conexao);
		}	
	}
?>
<html>
<head>
<title>Perfil de Usu�rio</title>
</head>

<body>
	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
	<div class="content">
	<form class="form-horizontal" name="frmUsuario" method="POST" action="alterarPerfil.php">
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
