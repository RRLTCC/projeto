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
<title>Vagas</title>
</head>

<body>
	<div class="content">

	<?php
	require_once 'conexao/conexao.php';
	
	$query = "SELECT * FROM empregador";
	$resultado = pg_query ($conexao, $query);
	?>
	<a href="index.php">Home</a> |
	<a href="incluirEmpregador.php">Adicionar Empregador</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
		
		<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Tipo</th>
			<th>N</th>
			<th>Razao Social</th>
			<th>Responsavel</th>
			<th>E-Mail</th>
			<th>Aceita?</th>
			<th>Telefone</th>
		</tr>
		<?php
		if(!$resultado){
			echo "<script language='javascript' type='text/javascript'>alert('N�o existem Empregadores!');
	     		  </script>";
		}else{
			while($res = pg_fetch_array($resultado)) {
				echo "<tr>";
				echo "<td>".$res['idtbEmpregador']."</td>";
				echo "<td>".$res['identificacaoTipo']."</td>";
				echo "<td>".$res['identificacaoNumero']."</td>";
				echo "<td>".$res['empregadorRazaoSocial']."</td>";
				echo "<td>".$res['responsavelNome']."</td>";
				echo "<td>".$res['responsavelEmail']."</td>";
				echo "<td>".$res['responsavelAceitarEmail']."</td>";
				echo "<td>".$res['responsavelTelefone']."</td>";
				echo "<td><a href=\"alterarEmpregador.php?idtbEmpregador=$res[idtbEmpregador]\">Editar</a> | 
				          <a href=\"excluirEmpregador.php?idtbEmpregador=$res[idtbEmpregador]\" 
				onClick=\"return confirm('Deseja mesmo excluir o Empregador?')\">Excluir</a></td>";
			}
		}
		?>
		</table>
		</div>	
</body>
</html>
<?php endblock('body-cont')?>
