<?php 
	session_start();
	// if(isset($_SESSION["usuario"]) && isset($_SESSION["senha"])){
		// Apaga a var de sessao
		unset($_SESSION['login']);
		unset($_SESSION['senha']);

		// Destruindo a sessão
		session_destroy();

		//Direcionar o user para a pag inicial
		echo "<meta http-equiv='refresh' content='0; ../../../pages/acesso.html'>";
	// };
?>