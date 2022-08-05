<?php
	$bco     = "DB_GERENCIAMENTO";
	$usuario = "root";
	$senha   = "";

	try{
		$conexao = new PDO("mysql:host=localhost; dbname=$bco", "$usuario", "$senha");
		$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexao -> exec("set names utf8");
	} catch(PDOException $erro){
		echo "<p style='display:none;'>Erro na conexão: " . $erro -> getMessage() . "</p>";
		echo "<script>alert(document.getElementsByTagName('p')[0].innerText);</script>";
		echo "<meta http-equiv='refresh' content='0; ../../../pages/acesso.html'>";
	};
?>