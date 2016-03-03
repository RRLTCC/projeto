<?php 
	session_start(); 
	include 'menu.html';
?>
 
<?php
	if (! isset ( $_SESSION ['valid'] )) {
		header ( 'Location: login.php' );
	}
?>
 
<?php
	require_once 'conexao/conexao.php';

	$idtbVaga = $_GET ['idtbVaga'];

	$vagaArray = array(
			'idtbVaga'  => "$idtbVaga"
	);
	
	$vagas= array($idtbVaga);
	
	foreach ($vagas as $chave => $vagaArray) {
			
		$resultado = pg_delete($conexao, 'vaga', $idtbVaga);
			
		if ($resultado) {
			echo "<script language='javascript' type='text/javascript'>alert('Vaga excluida com sucesso!');
					   				window.location.href='perfil.php';</script>";
			header ( "Location:selecionarVaga.php" );
		} else {
			echo pg_last_error($conexao) . " <br />";
		}
		pg_close($conexao);
	}
?>

