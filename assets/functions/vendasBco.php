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
		<title>Vendas</title>
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
			if(isset($_POST["cnpj"]))        { $cnpj     = $_POST["cnpj"];     };
			if(isset($_POST["nomeProd"]))    { $nomeProd = $_POST["nomeProd"]; };
			if(isset($_POST["data"]))        { $data     = $_POST["data"];     };
			if(isset($_POST["lote"]))        { $lote     = $_POST["lote"];     };
			if(isset($_POST["validade"]))    { $validade = $_POST["validade"]; };
			if(isset($_POST["preco"]))       { $preco    = $_POST["preco"];    };
			if(isset($_POST["equipeVendas"])){
				$equipeVendas = $_POST["equipeVendas"];
				if($equipeVendas == ""){
					$equipeVendas = null;
				};
			};

			// insere na tabela de vendas
			try{
				$comando = $conexao -> prepare("INSERT INTO TB_VENDAS VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)");
				# o quarto param é de DATA_VENDAS que recebe NOW()
				$comando -> bindParam(1, $cnpj);
				$comando -> bindParam(2, $codProd);
				$comando -> bindParam(3, $nomeProd);
				$comando -> bindParam(4, $lote);
				$comando -> bindParam(5, $validade);
				$comando -> bindParam(6, $preco);
				$comando -> bindParam(7, $equipeVendas);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						echo "<script>alert('Inclusão de item efetuada com sucesso!')</script>";
					} else{
						echo "<script>alert('Erro ao incluir item');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando.");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
			};

			// exclui do estoque
			try{
				$comando = $conexao -> prepare("DELETE FROM TB_ESTOQUE WHERE COD_PROD_ESTOQUE = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						$cnpj     = null;
						$codProd  = null;
						$nomeProd = null;
						$lote     = null;
						$validade = null;
						$preco    = null;
		
						echo "<script>alert('Item removido do estoque com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					} else{
						echo "<script>alert('Erro ao remover item do estoque');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando.");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
			};
		} elseif($botao == "Consultar"){
			try{
				$comando = $conexao -> prepare("SELECT * FROM TB_VENDAS WHERE COD_PROD_VENDAS = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						// inicia a criação html restante
						echo "<main>";
						echo 	"<div class='voltar-sair'>";
						echo 		"<a href='../../pages/vendas.php'>";
						echo 			"<abbr title='Voltar'>";
						echo 				"<img src='../media/seta0.PNG' alt='sair'>";
						echo 			"</abbr>";
						echo 		"</a>";
						echo 	"</div>";
						echo 	"<div class='container autoSizeContainer'>";
						echo		"<a href='../../../index.php' target='_self'><h1>Consulta Vendas</h1></a>";

						while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
							// cria o html restante 
							echo "<section>";
							echo	"<p><label>CNPJ parceiro:</label> "  . $linha -> CNPJ_VENDAS      . "</p>";
							echo	"<p><label>Código produto:</label> " . $linha -> COD_PROD_VENDAS  . "</p>";
							echo	"<p><label>Nome produto:</label> "   . $linha -> NOME_PROD_VENDAS . "</p>";
							echo	"<p><label>Data:</label> "           . $linha -> DATA_VENDAS      . "</p>";
							echo	"<p><label>Lote:</label> "           . $linha -> LOTE_VENDAS      . "</p>";
							echo	"<p><label>Validade:</label> "       . $linha -> VALIDADE_VENDAS  . "</p>";
							echo	"<p><label>Preço:</label> "          . $linha -> PRECO_VENDAS     . "</p>";
							echo	"<p><label>Equipe vendas:</label> "  . $linha -> EQUIPE_VENDAS    . "</p>";
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
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
			};
		} elseif($botao == "Excluir"){
			try{
				$comando = $conexao -> prepare("DELETE FROM TB_VENDAS WHERE COD_PROD_VENDAS = ?");
				$comando -> bindParam(1, $codProd);

				if($comando -> execute()){
					if($comando -> rowCount() > 0){
						$codProd = null;

						echo "<script>alert('Exclusão realizada com sucesso!')</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					} else{
						$codProd = null;

						echo "<script>alert('Código do produto inválido!');</script>";
						echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
					};
				} else{
					throw new PDOException("Erro: não foi possível executar o comando");
				};
			} catch(PDOException $erro){
				echo "<p style='display:none;' id='erro'>Erro: " . $erro -> getMessage() . "</p>";
				echo "<script>alert(document.querySelector('#erro').innerText);</script>";
				echo "<meta http-equiv='refresh' content='0; ../../pages/vendas.php'>";
			};
		}; // if qual botao
	}; // if isset botao
?>