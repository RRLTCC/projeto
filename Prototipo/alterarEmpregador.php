<?php session_start();include 'base.php'; ?>
<?php startblock('body-cont')?>
 
<?php
if (! isset ( $_SESSION ['valid'] )) {
	header ( 'Location: login.php' );
}
?>
<?php
	require_once 'conexao/conexao.php';
	
	$idtbEmpregador  = $_GET['idtbEmpregador'];

	$query     = "SELECT idtbEmpregador FROM empregador WHERE idtbEmpregador='$idtbEmpregador'";
	$resultado = pg_query($conexao, $query);

	while ($res = pg_fetch_array($resultado)){
		$idtbEmpregador          = $res['idtbEmpregador'];
		$identificacaoTipo       = $res['identificacaoTipo'];
		$identificacaoNumero     = $res['identificacaoNumero'];
		$empregadorRazaoSocial   = $res['empregadorRazaoSocial'];
		$responsavelNome         = $res['responsavelNome'];
		$responsavelEmail        = $res['responsavelEmail'];
		$responsavelAceitarEmail = $res['responsavelAceitarEmail'];
		$responsavelTelefone     = $res['responsavelTelefone'];
	}
?> 
<?php
	
	if (isset ( $_POST ['alterar'] )) {
		$idtbEmpregador          = $_POST['idtbEmpregador'];
		$identificacaoTipo       = $_POST['identificacaoTipo'];
		$identificacaoNumero     = $_POST['identificacaoNumero'];
		$empregadorRazaoSocial   = $_POST['empregadorRazaoSocial'];
		$responsavelNome         = $_POST['responsavelNome'];
		$responsavelEmail        = $_POST['responsavelEmail'];
		$responsavelAceitarEmail = $_POST['responsavelAceitarEmail'];
		$responsavelTelefone     = $_POST['responsavelTelefone'];
		
		$empregadorArray = array(
				'idtbEmpregador'          => "$idtbEmpregador",
				'identificacaoTipo'       => "$identificacaoTipo",
				'identificacaoNumero'     => "$identificacaoNumero",
				'empregadorRazaoSocial'   => "$empregadorRazaoSocial",
				'responsavelNome'         => "$responsavelNome",
				'responsavelEmail'        => "$responsavelEmail",
				'responsavelAceitarEmail' => "$responsavelAceitarEmail",
				'responsavelTelefone'     => "$responsavelTelefone"
		);
			
		$condicao = array(
				'idtbEmpregador' => "$idtbEmpregador"
		);
			
		$empregadores= array($empregadorArray);
		
		foreach ($empregadores as $chave => $empregadorArray) {
				
			$resultado = pg_update($conexao, 'perfil', $perfilArray, $condicao);
				
			if ($resultado) {
				echo "<script language='javascript' type='text/javascript'>alert('Empregador alterado com sucesso!');
				   				window.location.href='selecionarEmpregador.php';</script>";
			} else {
				echo pg_last_error($conexao);
			}
			pg_close($conexao);
		}	
	}
?>
<html>
<head>
<title>Empregadores</title>
</head>

<body>
	<a href="index.php">Home</a> |
	<a href="logout.php">Logout</a>
	<br />
	<br />
	<div class="content">
<form class="form-horizontal" name="frmEmpregador" method="POST" action="alterarEmpregador.php">
		<div class="form-group">
			<label class="col-sm-2">ID </label>
         <input type="text" id="idtbEmpregador"          name="idtbEmpregador">  <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Tipo </label>
			        <input type="text" id="identificacaoTipo"       name="identificacaoTipo">    <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> N   </label>
			       <input type="text" id="identificacaoNumero"     name="identificacaoNumero">      <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Razao Social </label>
			<input type="text" id="empregadorRazaoSocial"   name="empregadorRazaoSocial">   <br>
		
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Responsavel </label>
		 <input type="text" id="responsavelNome"         name="responsavelNome">   <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2">E-Mail </label>
			      <input type="text" id="responsavelEmail"        name="responsavelEmail">   <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Aceita?</label>
			      <input type="text" id="responsavelAceitarEmail" name="responsavelAceitarEmail">   <br>
		</div>
		<div class="form-group">
			<label class="col-sm-2"> Telefone</label>
			     <input type="text" id="responsavelTelefone"     name="responsavelTelefone">   <br>
		</div>
		          <input type="submit" name="Incluir" value="Incluir"> 
		          <a href='selecionarEmpregador.php'>Voltar</a>
	</form>

	</div>
</body>
</html>
<?php endblock('body-cont')?>