<?php session_start();
include 'menu.html';
?>
 
<?php
	if (! isset ( $_SESSION ['valid'] )) {
		header ( 'Location: login.php' );
	}
?>
 
<?php
require_once 'conexao/conexao.php';

$idPerfil = $_GET ['idPerfil'];

$idPerfil = array(
		'idPerfil'  => "$idPerfil"
);

$perfis= array($idPerfil);

foreach ($perfis as $key => $idPerfil) {
		
	$resultado = pg_delete($conexao, 'perfil', $idPerfil);
		
	if ($resultado) {
		echo "<script language='javascript' type='text/javascript'>alert('Perfil excluido com sucesso!');
				   				window.location.href='selecionarPerfil.php';</script>";
	} else {
		echo pg_last_error($conexao) . " <br />";
	}
	pg_close($conexao);
}
?>
