<?php session_start(); ?>
<?php include 'base.php'?>

<?php startblock('body-cont')?>
<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
 
<html>
<head>
<title>Vagas</title>
</head>

<body>
	<div class="content">

	<?php
	require_once 'conexao/conexao.php';
	
	$query = "SELECT * FROM vaga";
	$resultado = pg_query ($conexao, $query);
	?>
	<a href="index.php">Home</a> |
	<a href="incluirVaga.php">Adicionar Vaga</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
		
		<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Descrição</th>
			<th>Cargo</th>
			<th>Sexo</th>
			<th>CEP</th>
			<th>Logradouro</th>
			<th>N</th>
			<th>Bairro</th>
			<th>Municipio</th>
		</tr>
		<?php
		if(!$resultado){
			echo "<script language='javascript' type='text/javascript'>alert('N�o existem vagas!');
	     		  </script>";
		}else{
			while($res = pg_fetch_array($resultado)) {
				echo "<tr>";
				echo "<td>".$res['idtbVaga']."</td>";
				echo "<td>".$res['idtbEmpregador']."</td>";
				echo "<td>".$res['cargo']."</td>";
				echo "<td>".$res['sexo']."</td>";
				echo "<td>".$res['cep']."</td>";
				echo "<td>".$res['logradouro']."</td>";
				echo "<td>".$res['numero']."</td>";
				echo "<td>".$res['bairro']."</td>";
				echo "<td>".$res['municipio']."</td>";
				echo "<td><a href=\"alterarVaga.php?idtbVaga=$res[idtbVaga]\">Editar</a> | 
				          <a href=\"excluirVaga.php?idtbVaga=$res[idtbVaga]\" 
				onClick=\"return confirm('Deseja mesmo excluir a Vaga?')\">Excluir</a></td>";
			}
		}
		?>
		</table>
		</div>	
</body>
</html>
<?php endblock('body-cont')?>
