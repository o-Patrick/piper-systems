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
		<title>Compras</title>
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
		// declaração de variáveis que são usadas em mais de um caso de botão
		$botao = $_POST["botao"];
		if(isset($_POST["codProd"])){ $codProd = $_POST["codProd"]; };

		// testa o botão clicado
		if($botao == "Incluir"){
			// declaração de variáveis que só são usadas na inclusão
			if(isset($_POST["cnpj"]))    { $cnpj     = $_POST["cnpj"];     };
			if(isset($_POST["nomeProd"])){ $nomeProd = $_POST["nomeProd"]; };
			if(isset($_POST["lote"]))    { $lote     = $_POST["lote"];     };
			if(isset($_POST["validade"])){ $validade = $_POST["validade"]; };
			if(isset($_POST["preco"]))   { $preco    = $_POST["preco"];    };

			// insere na tabela de compras
			try{
				$comando = $conexao -> prepare("INSERT INTO TB_COMPRAS VALUES (?, ?, ?, NOW(), ?, ?, ?)");
				# o quarto param é de DATA_COMPRAS que recebe NOW()
				$comando -> bindParam(1, $cnpj);
				$comando -> bindParam(2, $codProd);
				$comando -> bindParam(3, $nomeProd);
				$comando -> bindParam(4, $lote);
				$comando -> bindParam(5, $validade);
				$comando -> bindParam(6, $preco);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						echo "<script>alert('Compra registrada com sucesso!')</script>";
					} else{
						echo "<script>alert('Erro ao registrar compra!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando.");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
			};

			// insere no estoque
			try{
				$comando = $conexao -> prepare("INSERT INTO TB_ESTOQUE VALUES (?, ?, ?, NOW(), ?, ?, ?)");
				# o quarto param é de DATA_COMPRAS que recebe NOW()
				$comando -> bindParam(1, $cnpj);
				$comando -> bindParam(2, $codProd);
				$comando -> bindParam(3, $nomeProd);
				$comando -> bindParam(4, $lote);
				$comando -> bindParam(5, $validade);
				$comando -> bindParam(6, $preco);
		
				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						echo "<script>alert('Compra registrada no estoque com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					} else{
						echo "<script>alert('Erro ao registrar compra no estoque!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando.");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
			};
		} elseif($botao == "Consultar"){
			try{
				$comando = $conexao -> prepare("SELECT * FROM TB_COMPRAS WHERE COD_PROD_COMPRAS = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						// inicia a criação html restante
						echo "<main>";
						echo 	"<div class='voltar-sair'>";
						echo 		"<a href='../../pages/compras.php'>";
						echo 			"<abbr title='Voltar'>";
						echo 				"<img src='../media/seta0.PNG' alt='sair'>";
						echo 			"</abbr>";
						echo 		"</a>";
						echo 	"</div>";
						echo 	"<div class='container autoSizeContainer'>";
						echo		"<a href='../../../index.php' target='_self'><h1>Consulta Compras</h1></a>";

						while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
							// cria o html restante 
							echo "<section>";
							echo	"<p><label>CNPJ parceiro:</label> "  . $linha -> CNPJ_COMPRAS      . "</p>";
							echo	"<p><label>Código produto:</label> " . $linha -> COD_PROD_COMPRAS  . "</p>";
							echo	"<p><label>Nome produto:</label> "   . $linha -> NOME_PROD_COMPRAS . "</p>";
							echo	"<p><label>Data:</label> "           . $linha -> DATA_COMPRAS      . "</p>";
							echo	"<p><label>Lote:</label> "           . $linha -> LOTE_COMPRAS      . "</p>";
							echo	"<p><label>Validade:</label> "       . $linha -> VALIDADE_COMPRAS  . "</p>";
							echo	"<p><label>Preço:</label> "          . $linha -> PRECO_COMPRAS     . "</p>";
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
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
			};
		} elseif($botao == "Excluir"){
			try{
				$comando = $conexao -> prepare("DELETE FROM TB_COMPRAS WHERE COD_PROD_COMPRAS = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						$codProd = null;
						echo "<script>alert('Exclusão realizada com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					} else{
						$codProd = null;
						echo "<script>alert('Código do produto inválido!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/compras.php'>";
			};
		}; // if qual botao
	}; // if isset botao
?>