<?php session_start();
include 'base.php';
?>
 
<?php startblock('body-cont')?> 
<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>
 
<html>
<head>
<title>Perfis</title>
</head>

<body>
	<div class="content">
	<?php
	require_once 'conexao/conexao.php';
	
	$query = "SELECT * FROM perfil";
	$resultado = pg_query ($conexao, $query);
	?>

	<a href="index.php">Home</a> |
	<a href="incluirPerfil.php">Adicionar Perfil</a> |
	<a href="logout.php">Logout</a>

		
		<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Descrição</th>
		</tr>
		<?php
		while($res = pg_fetch_array($resultado)) {
			echo "<tr>";
			echo "<td>".$res['idPerfil']."</td>";
			echo "<td>".$res['descricao']."</td>";
			echo "<td><a href=\"alterarPerfil.php?idPerfil=$res[idPerfil]\">Editar</a> | 
			          <a href=\"excluirPerfil.php?idPerfil=$res[idPerfil]\" 
			onClick=\"return confirm('Deseja mesmo excluir o Perfil?')\">Excluir</a></td>";
		}
		?>
		</table>
		</div>	
</body>
</html>
<?php endblock('body-cont')?>