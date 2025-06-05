<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerador de Rifas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>🎟️ Gerador de Rifas</h1>

        <form method="post">
            <label for="campanha">Nome da Campanha:</label>
            <input type="text" name="campanha" id="campanha" required>

            <label for="premio">Prêmio(s):</label>
            <input type="text" name="premio" id="premio" required>

            <label for="valor">Valor do Bilhete (R$):</label>
            <input type="text" name="valor" id="valor" required>

            <label for="quantidade">Quantidade de Bilhetes:</label>
            <input type="number" name="quantidade" id="quantidade" min="1" required>

            <button type="submit" class="botao">Gerar Rifas</button>
            <button class="imprimir" onclick="window.print()">🖨️ Imprimir Bilhetes</button>
            <button class="limpar" onclick="limparRifas()">🧹 Limpar Rifas</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php
            $campanha = htmlspecialchars($_POST["campanha"]);
            $premio = htmlspecialchars($_POST["premio"]);
            $valor = htmlspecialchars($_POST["valor"]);
            $quantidade = (int)$_POST["quantidade"];
            ?>

            <div class="rifas" id="rifas">
                <h2><?= $campanha ?></h2>
                <p><strong>Prêmio:</strong> <?= $premio ?></p>
                <p><strong>Valor da Rifa:</strong> R$ <?= $valor ?></p>
                <h3>Bilhetes Gerados:</h3>

                <?php for ($i = 1; $i <= $quantidade; $i++): ?>
                    <div class="bilhete">
                        <div class="numero">Nº <?= str_pad($i, 3, "0", STR_PAD_LEFT) ?></div>
                        <div class="info">
                            <p><strong>Campanha:</strong> <?= $campanha ?></p>
                            <p><strong>Prêmio:</strong> <?= $premio ?></p>
                            <p><strong>Valor:</strong> R$ <?= $valor ?></p>
                        </div>
                    </div>
                <?php endfor; ?>

            </div>
        <?php endif; ?>
    </div>

    <script>
        function limparRifas() {
            const rifas = document.getElementById("rifas");
            if (rifas) {
                rifas.style.display = "none";
            }
        }
    </script>
</body>

</html>