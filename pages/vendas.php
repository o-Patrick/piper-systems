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
        <title>Vendas</title>
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
            <div class="container autoSizeContainer">
                <a href="../index.php">
                    <h1>Vendas</h1>
                </a>
                <form action="../assets/functions/vendasBco.php" method="post">
                    <label for="cnpj">CNPJ parceiro: </label>
                    <input type="text" name="cnpj" id="cnpj" tabindex="1"><br>

                    <label for="codProd">Código produto: </label>
                    <input type="text" name="codProd" id="codProd" tabindex="2"><br>

                    <label for="nomeProd">Nome produto: </label>
                    <input type="text" name="nomeProd" id="nomeProd" tabindex="3"><br>

                    <label for="lote">Lote: </label>
                    <input type="text" name="lote" id="lote" tabindex="4"><br>

                    <label for="validade">Validade: </label>
                    <input type="datetime-local" name="validade" id="validade" tabindex="5"><br>

                    <label for="preco">Preço: </label>
                    <input type="text" name="preco" id="preco" tabindex="6"><br>

                    <label for="equipeVendas">Equipe vendas: </label>
                    <select name="equipeVendas" id="equipeVendas" tabindex="7">
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>

                    <div class="botoes">
                        <input type="submit" name="botao" id="incluir" class="botao primario" value="Incluir" tabindex="8">
                        <input type="submit" name="botao" id="consultar" class="botao secundario" value="Consultar" tabindex="9">
                        <input type="submit" name="botao" id="excluir" class="botao secundario" value="Excluir" tabindex="10">
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <p>Piper Systems &copy; 2022. Todos os direitos reservados.</p>
        </footer>
    </body>
</html>