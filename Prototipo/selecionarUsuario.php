<?php session_start(); 	?>
<?php include 'base.php';?>

<?php startblock('body-cont')?> 
<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<?php
	require_once 'conexao/conexao.php';
	
	$query = "SELECT * FROM usuario";
	$resultado = pg_query ($conexao, $query);
?>
<html>
<head>
<title>Perfis</title>
</head>

<body>
	<div class="content">

	<a href="index.php">Home</a> |
	<a href="incluirUsuario.php">Adicionar Usuario</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
		
		<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Usuario</th>
			<th>Senha</th>
			<th>Lembrete</th>
			<th>Perfil</th>
		</tr>
		<?php
		while($res = pg_fetch_array($resultado)) {
			echo "<tr>";
			echo "<td>".$res['idUsuario']."</td>";
			echo "<td>".$res['usuario']."</td>";
			echo "<td>".$res['senha']."</td>";
			echo "<td>".$res['lembrete']."</td>";
			echo "<td>".$res['idPerfil']."</td>";
			echo "<td><a href=\"alterarUsuario.php?idUsuario=$res[idUsuario]\">Editar</a> | 
			          <a href=\"excluirUsuario.php?idUsuario=$res[idUsuario]\" 
			onClick=\"return confirm('Deseja mesmo excluir o Usuario?')\">Excluir</a></td>";
		}
		?>
		</table>	
		</div>
</body>
</html>
<?php endblock('body-cont')?>

