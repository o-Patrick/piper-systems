<?php
    // requer o login para prosseguir
    require "../assets/functions/acesso/verificador.php";
    $_SESSION["pagina"] = "";
    verificadorLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../assets/styles/mainContainer.css">
    <link rel="stylesheet" href="../assets/styles/form.css">
    <title>Estoque</title>
</head>
<body>
    <header>
        <div class="container">
            <picture>
                <a href="../index.php">
                    <img src="#" alt="Logo parceiro">
                </a>
                |   <!-- pipe que separa as logos, não uma marca de indentação -->
                <a href="../index.php">
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
    <main>
        <div class="voltar-sair">
            <a href="../index.php">
                <abbr title="Sair">
                    <img src="../assets/media/seta0.PNG" alt="sair">
                </abbr>
            </a>
        </div>
        <div class="container fixedSizeContainer">
            <a href="../index.php">
                <h1>Estoque</h1>
            </a>
            <form action="../assets/functions/estoqueBco.php" method="post">
                <label for="codProd">Código produto: </label>
                <input type="text" name="codProd" id="codProd" tabindex="1"><br>

                <div class="botoes">
                    <input type="submit" name="botao" id="consultar" class="botao primario" value="Consultar" tabindex="2">
                    <input type="submit" name="botao" id="excluir" class="botao secundario" value="Excluir" tabindex="3">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>Piper Systems &copy; 2022. Todos os direitos reservados.</p>
    </footer>
</body>
</html>