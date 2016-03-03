<?php session_start();include 'base.php'; ?>

<?php startblock('body-cont')?>
<?php
	if (! isset ( $_SESSION ['valid'] )) {
		header ( 'Location: login.php' );
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Vagas</title>
</head>
<body>
<?php
require_once 'conexao/conexao.php';

if (isset ( $_POST ['Incluir'] )) {
	$idtbVaga       = $_POST ['idtbVaga'];
	$idtbEmpregador = $_POST ['idtbEmpregador'];
	$cargo          = $_POST ['cargo'];
	$sexo           = $_POST ['sexo'];
	$cep            = $_POST ['cep'];
	$logradouro     = $_POST ['logradouro'];
	$numero         = $_POST ['numero'];
	$bairro         = $_POST ['bairro'];
	$municipio      = $_POST ['municipio'];
	
	$vagaArray = array (
			'idtbVaga'       => "$idtbVaga",
			'idtbEmpregador' => "$idtbEmpregador",
			'cargo'          => "$cargo",
			'sexo'           => "$sexo",
			'cep'            => "$cep",
			'logradouro'     => "$logradouro",
			'numero'         => "$numero",
			'bairro'         => "$bairro",
			'municipio'      => "$municipio"
	);
	
	$vagas = array (
			$vagaArray 
	);
	
	foreach ( $vagas as $chave => $vagaArray ) {
		
		$resultado = pg_insert ( $conexao, 'vaga', $vagaArray );
		echo $resultado;
		
		if ($resultado) {
			echo "<script language='javascript' type='text/javascript'>alert('Vaga incluida com sucesso!');
	     				window.location.href='selecionarVaga.php';</script>";
		} else {
			echo pg_last_error ( $conexao ) . " <br />";
		}
	}
	pg_close ( $conexao );
}
?>
	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
	<div class="content">
	<form class="form-horizontal" name="frmVaga" method="POST" action="incluirVaga.php">
		<div class="form-group">
			<label class="col-sm-2">ID         </label>
			<input type="text" id="idtbVaga"         name="idtbVaga"> 
		</div>  
		<div class="form-group">	
			<label class="col-sm-2">Empregador </label>
			<input type="text" id="idtbEmpregador"   name="idtbEmpregador">     
		</div>
		<div class="form-group">	
			<label class="col-sm-2">Cargo      </label>
			<input type="text" id="cargo"            name="cargo">       
		</div>
		<div class="form-group">			
			<label class="col-sm-2">Sexo       </label>
			<input type="text" id="sexo"             name="sexo">    
		</div>
		<div class="form-group">
			<label class="col-sm-2">CEP        </label>
			<input type="text" id="cep"              name="cep">    
		</div>
		<div class="form-group">
			<label class="col-sm-2">Logradouro </label>
			<input type="text" id="logradouro"       name="logradouro">    
		</div>
		<div class="form-group">	
			<label class="col-sm-2">N          </label>
			<input type="text" id="numero"           name="numero">    
		</div>
		<div class="form-group">
			<label class="col-sm-2">Bairro     </label>
			<input type="text" id="bairro"           name="bairro">    
		</div>
		<div class="form-group">
			<label class="col-sm-2">Municipio  </label>
			<input type="text" id="municipio"        name="municipio">  
		</div>  
			           <input type="submit" name="Incluir" value="Incluir"> 
			           <a href='selecionarVaga.php'>Voltar</a>
	</form>
	</div>
</body>
</html>
<?php endblock('body-cont')?>