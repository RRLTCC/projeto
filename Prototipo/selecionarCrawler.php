<?php session_start();
include 'base.php';
?>
 
<?php startblock('body-cont')?> 
<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>
<?php
	require_once 'conexao/conexao.php';
	$botao  = "<input type='button' value='Adicionar'>";
	$check  = "<input type='checkbox' name='favorito' value=''>";
	$select = "<select><option value='N'>Neutra</option>
		               <option value='A'>Andamento</option>
		               <option value='F'>Finalizada</option>
		      </select>";

	$query  = "SELECT * FROM vagas_crawler";
	
	$resultado = pg_query ($conexao, $query);
?>
<html>
<head>
<title>Vagas do Crawler</title>
</head>
<body>
	<div class="content">

	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />	
		<table class="table table-bordered">
		<tr>
		<th>ID</th>
		<th>Data</th>
		<th>Link</th>
		<th>Site</th>
		<th>Favorito</th>
		<th>Status</th>
		</tr>
		<?php
		while($res = pg_fetch_array($resultado)) {
			echo "<tr>";
			echo "<td>".$res['idOportunidade']."</td>";
			echo "<td>".$res['data']."</td>";
			echo "<td>".$res['link']."</td>";
			echo "<td>".$res['site']."</td>";
			//echo "<td>".$res['favorito']."</td>";
			echo "<td>".$check."</td>";
			//echo "<td>".$res['status']."</td>";
			echo "<td>".$select."</td>";
			echo "<td>".$botao."</td>";
			//echo "<td><a href=\"adicionarArea.php?idOportunidade=$res[idOportunidade]\" 
			//onClick=\"return confirm('Deseja mesmo adicionar a area de trabalho?')\">Adicionar</a></td>";
		}
		?>
		</table>	
		</div>
</body>
</html>
<?php endblock('body-cont')?>

