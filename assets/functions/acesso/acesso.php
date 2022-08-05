<?php

	session_start();

	require "../conexao.php";

	if(isset($_POST["botao"])){
		if(isset($_POST["usuario"])){
			$usuario = $_POST["usuario"];
			$_SESSION['usuario'] = $usuario;
		};
		if(isset($_POST["senha"])){
			$senha = $_POST["senha"];  
			$_SESSION['senha'] = $senha;
		};

		try{
			$comando = $conexao -> prepare("SELECT * FROM TB_ACESSO WHERE USUARIO_ACESSO = ? AND SENHA_ACESSO = ?");
			$comando -> bindParam(1, $usuario);
			$comando -> bindParam(2, $senha);

			if($comando -> execute()){
				if($comando -> rowCount() > 0){
					$usuario = null;
					$senha   = null;

					echo "<script>alert('Login efetuado com sucesso!')</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../index.php'>";
				} else{
					$usuario = null;
					$senha   = null;

					echo "<script>alert('Usuário ou senha inválidos!');</script>";
					echo "<meta http-equiv='refresh' content='0; ../../../pages/acesso.html'>";
				};
			} else{
				throw new PDOException("Erro: não foi possível executar o comando");
			};
		} catch(PDOException $erro){
			echo "<p style='display:none;'>Erro: " . $erro -> getMessage() . "</p>";
			echo "<script>alert(document.getElementsByTagName('p')[0].innerText);</script>";
			echo "<meta http-equiv='refresh' content='0; ../../../pages/acesso.html'>";
		};
	};

?>