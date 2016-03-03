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

$idtbEmpregador = $_GET ['idtbEmpregador'];

$empregadorArray = array(
		'idtbEmpregador'  => "$idtbEmpregador"
);

$empregadores = array($empregadorArray);

foreach ($empregadores as $chave => $empregadorArray) {
		
	$resultado = pg_delete($conexao, 'empregador', $empregadorArray);
		
	if ($resultado) {
		echo "<script language='javascript' type='text/javascript'>alert('Empregador excluido com sucesso!');
				   				window.location.href='selecionarEmpregador.php';</script>";
	} else {
		echo pg_last_error($conexao) . " <br />";
	}
	pg_close($conexao);
}
?>
