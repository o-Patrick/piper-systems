<?php
    // requer o login para prosseguir
    require "assets/functions/acesso/verificador.php";
    $_SESSION["pagina"] = "index";
    verificadorLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/mainContainer.css">
    <link rel="stylesheet" href="assets/styles/menuIndex.css">
    <title>Início</title>
</head>
<body>
    <header>
        <div class="container">
            <picture>
                <a href="index.php">
                    <img src="#" alt="Logo parceiro">
                </a>
                |   <!-- pipe que separa as logos, não uma marca de indentação -->
                <a href="index.php">
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
            <a href="assets/functions/acesso/logout.php">
                <abbr title="Sair">
                    <img src="assets/media/seta0.PNG" alt="sair">
                </abbr>
            </a>
        </div>
        <div class="container fixedSizeContainer">
            <a href="index.php">
                <h1>Início</h1>
            </a>
            <section>
                <ul>
                    <a href="pages/estoque.php">
                        <li>Estoque</li>
                    </a>
                    <a href="pages/vendas.php">
                        <li>Vendas</li>
                    </a>
                    <a href="pages/compras.php">
                        <li>Compras</li>
                    </a>
                    <a href="pages/parceiros.php">
                        <li>Parceiros</li>
                    </a>
                </ul>
            </section>
        </div>
    </main>
    <footer class="fixedSizeFooter">
        <p>Piper Systems &copy; 2022. Todos os direitos reservados.</p>
    </footer>
</body>
</html>