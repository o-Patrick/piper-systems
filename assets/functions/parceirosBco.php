<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../styles/style.css">
		<link rel="stylesheet" href="../styles/mainContainer.css">
		<link rel="stylesheet" href="../styles/form.css">
		<link rel="stylesheet" href="../styles/consulta.css">
		<title>Parceiros</title>
	</head>
	<body>
		<header>
			<div class="container">
				<picture>
					<a href="../../index.php">
						<img src="#" alt="Logo parceiro">
					</a>
					|   <!-- pipe que separa as logos, não uma marca de indentação -->
					<a href="../../index.php">
						<img src="#" alt="Logo Piper Systems">
					</a>
				</picture>
				<div>
					<p>Contato suporte:</p>
					<p>exemplo@exemplo.com</p>
					<p>(XX) XXXX-XXXX</p>
				</div>
			</div>
		</header>
	</body>
</html>

<?php
// '07494654000168' (real e válido) '51131969000132' (real e válido)'07711478000179' (real e válido)
	require "conexao.php";
	require "validadorCnpj.php";

	if(isset($_POST["botao"])){
		// var
		$botao = $_POST["botao"];
		if(isset($_POST["cnpj"])){ $cnpj = $_POST["cnpj"]; };

		// testa o botão clicado
		if($botao == "Incluir"){
			// var somente usada na inclusão
			if(isset($_POST["razaoSocial"])){ $razaoSocial = $_POST["razaoSocial"]; };
			
			// validado o cnpj para incluir
			if(validador($cnpj) == true){
				try{
					$comando = $conexao -> prepare("INSERT INTO TB_PARCEIROS VALUES (?, ?, NOW())");
					# o terceiro param é de DATA_PARCEIROS que recebe NOW()
					$comando -> bindParam(1, $cnpj);
					$comando -> bindParam(2, $razaoSocial);
			
					if($comando -> execute()){
						if($comando -> rowCount() > 0){
							$cnpj        = null;
							$razaoSocial = null;
							echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
							echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
						} else{
							echo "<script>alert('Erro ao efetivar cadastro');</script>";
							echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
						};
					} else{
						throw new PDOException("Erro: não foi possível executar o comando.");
					};
				} catch(PDOException $erro){
					echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
					echo "<script>alert(document.querySelector('#erro').innerText);</script>";
					echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
				};
			} else{
				echo "<script>alert('CNPJ inválido!');</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
			}; // if validador
		} elseif($botao == "Consultar"){
			try{
				$comando = $conexao -> prepare("SELECT * FROM TB_PARCEIROS WHERE CNPJ_PARCEIROS = ?");
				$comando -> bindParam(1, $cnpj);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						// inicia a criação html restante
						echo "<main>";
						echo 	"<div class='voltar-sair'>";
						echo 		"<a href='../../pages/parceiros.php'>";
						echo 			"<abbr title='Voltar'>";
						echo 				"<img src='../media/seta0.PNG' alt='sair'>";
						echo 			"</abbr>";
						echo 		"</a>";
						echo 	"</div>";
						echo 	"<div class='container autoSizeContainer'>";
						echo		"<a href='../../../index.php' target='_self'><h1>Consulta Parceiros</h1></a>";

						while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
							// cria o html restante 
							echo "<section>";
							echo	"<p><label>CNPJ:</label> "         . $linha -> CNPJ_PARCEIROS          . "</p>";
							echo	"<p><label>Razão Social:</label> " . $linha -> RAZAO_SOCIAL_PARCEIROS  . "</p>";
							echo	"<p><label>Data:</label> "         . $linha -> DATA_INCLUSAO_PARCEIROS . "</p>";
							echo "</section>";
						};
						// finaliza o html na repetição		
						echo 	"</div>";
						echo "</main>";
						echo "<footer>";
						echo 	"<p>Piper Systems &copy; 2022. Todos os direitos reservados.</p>";
						echo "</footer>";

						// finalização
						echo "<script>alert('Consulta realizada com sucesso!')</script>";
					} else{
						echo "<script>alert('CNPJ não encontrado!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
			};
		} elseif($botao == "Excluir"){
			try{
				$comando = $conexao -> prepare("DELETE FROM TB_PARCEIROS WHERE CNPJ_PARCEIROS = ?");
				$comando -> bindParam(1, $cnpj);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						$cnpj = null;

						echo "<script>alert('Exclusão realizada com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
					} else{
						$codProd = null;

						echo "<script>alert('CNPJ inválido!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/parceiros.php'>";
			};
		}; // if qual botao
	}; // if isset botao
?>