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

$idUsuario = $_GET ['idUsuario'];

$idUsuario = array(
		'idUsuario'  => "$idUsuario"
);

$usuarios = array($idUsuario);

foreach ($usuarios as $chave => $idUsuario) {
		
	$resultado = pg_delete($conexao, 'usuario', $idUsuario);
		
	if ($resultado) {
		echo "<script language='javascript' type='text/javascript'>alert('Usu�rio excluido com sucesso!');
				   				window.location.href='selecionarUsuario.php';</script>";
	} else {
		echo pg_last_error($conexao) . " <br />";
	}
	pg_close($conexao);
}
?>

