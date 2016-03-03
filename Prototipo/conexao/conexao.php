<?php
$host = "localhost";
$porta = "5432";
$bd = "mrcrawler_beta";
$usuario = "postgres";
$senha = "root";
$pg_options = "--client_encoding=UTF8";

$string = "host={$host} port={$porta} dbname={$bd} user={$usuario} password={$senha} options='{$pg_options}'";
$conexao = pg_connect ( $string );

if ($conexao) {
	// echo "Conectado a ". pg_host($conexao);
} else {
	echo "Erro ao conectar a base de dados";
}

echo "<br />";

?>
