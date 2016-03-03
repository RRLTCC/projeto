<?php session_start();include 'base.php'; ?>

<?php startblock('body-cont')?> 
<?php
if (! isset ( $_SESSION ['valid'] )) {
	header ( 'Location: login.php' );
}
?>
<?php
	require_once 'conexao/conexao.php';
	
	$idUsuario  = $_GET['idUsuario'];

	$query     = "SELECT idUsuario FROM usuario WHERE idUsuario='$idUsuario'";
	$resultado = pg_query($conexao, $query);

	while ($res = pg_fetch_array($resultado)){
		$usuario  = $res['usuario'];
		$senha    = $res['senha'];
		$lembrete = $res['lembrete'];
		$idPerfil = $res['idPerfil'];
	}
?> 
<?php
	
	if (isset ( $_POST ['alterar'] )) {
		$idUsuario = $_POST['idUsuario'];
		$usuario   = $_POST['usuario'];
		$senha     = $_POST['senha'];
		$lembrete  = $_POST['lembrete'];
		$idPerfil  = $_POST['idPerfil'];
		
		$usuarioArray = array(
				'usuario'  => "$usuario",
				'senha'    => "$senha",
				'lembrete' => "$lembrete",
				'idPerfil' => "$idPerfil"
		);
			
		$condicao = array(
				'idUsuario' => "$idUsuario"
		);
			
		$usuarios= array($usuarioArray);
		
		foreach ($usuarios as $chave => $usuarioArray) {
				
			$resultado = pg_update($conexao, 'usuario', $usuarioArray, $condicao);
				
			if ($resultado) {
				echo "<script language='javascript' type='text/javascript'>alert('Usu�rio alterado com sucesso!');
				   				window.location.href='selecionarUsuario.php';</script>";
			} else {
				echo pg_last_error($conexao);
			}
			pg_close($conexao);
		}	
	}
?>
<html>
<head>
<title>Usuarios</title>
</head>

<body>
	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
	<div class="content">
	<form class="form-horizontal" name="frmUsuario" method="POST" action="alterarUsuario.php">
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
