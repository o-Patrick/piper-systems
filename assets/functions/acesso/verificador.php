<?php

	session_start();

	function verificadorLogin(){
		// verifica se o usuário está logado
		if(!isset($_SESSION["usuario"]) && !isset($_SESSION["senha"])){
			// verifica se foi definida qual página a pessoa acessou antes do login
			if($_SESSION["pagina"] == "index"){
				echo "<meta http-equiv='refresh' content='0; pages/acesso.html'>";
			} else{
				echo "<meta http-equiv='refresh' content='0; acesso.html'>";
			};
		};
	};

?>