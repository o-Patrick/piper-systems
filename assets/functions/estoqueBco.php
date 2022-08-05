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
		<title>Estoque</title>
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

	if(isset($_POST["botao"])){
		// var
		$botao = $_POST["botao"];
		if(isset($_POST["codProd"])){ $codProd = $_POST["codProd"]; };

		if($botao == "Consultar"){
			try{
				$comando = $conexao -> prepare("SELECT * FROM TB_ESTOQUE WHERE COD_PROD_ESTOQUE = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					$codProd = null;
					if($comando -> rowCount() > 0){
						// inicia a criação html restante
						echo "<main>";
						echo 	"<div class='voltar-sair'>";
						echo 		"<a href='../../pages/estoque.php'>";
						echo 			"<abbr title='Voltar'>";
						echo 				"<img src='../media/seta0.PNG' alt='sair'>";
						echo 			"</abbr>";
						echo 		"</a>";
						echo 	"</div>";
						echo 	"<div class='container autoSizeContainer'>";
						echo		"<a href='../../index.php' target='_self'><h1>Consulta Estoque</h1></a>";

						while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
							// cria o html restante 
							echo "<section>";
							echo	"<p><label>CNPJ parceiro:</label> "  . $linha -> CNPJ_ESTOQUE    . "</p>";
							echo	"<p><label>Código produto:</label> " . $linha -> COD_PROD_ESTOQUE  . "</p>";
							echo	"<p><label>Nome produto:</label> "   . $linha -> NOME_PROD_ESTOQUE . "</p>";
							echo	"<p><label>Data:</label> "           . $linha -> DATA_ESTOQUE      . "</p>";
							echo	"<p><label>Lote:</label> "           . $linha -> LOTE_ESTOQUE      . "</p>";
							echo	"<p><label>Validade:</label> "       . $linha -> VALIDADE_ESTOQUE  . "</p>";
							echo	"<p><label>Preço:</label> "          . $linha -> PRECO_ESTOQUE     . "</p>";
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
						echo "<script>alert('Código do produto não encontrado!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/estoque.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/estoque.php'>";
			};
		} elseif($botao == "Excluir"){
			try{
				$comando = $conexao -> prepare("DELETE FROM TB_ESTOQUE WHERE COD_PROD_ESTOQUE = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					$codProd = null;
					if($comando -> rowCount() > 0){
						echo "<script>alert('Exclusão realizada com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/estoque.php'>";
					} else{
						echo "<script>alert('Código do produto inválido!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/estoque.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/estoque.php'>";
			};
		}; // if qual botao
	}; // if isset botao
?>