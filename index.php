<?php
$mensagem = "";
$bilhetes = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $campanha = trim($_POST["campanha"] ?? '');
    $premio = trim($_POST["premio"] ?? '');
    $valor = floatval($_POST["valor"] ?? 0);
    $quantidade = intval($_POST["quantidade"] ?? 0);

    if ($campanha && $premio && $valor > 0 && $quantidade > 0) {
        for ($i = 1; $i <= $quantidade; $i++) {
            $bilhetes[] = str_pad($i, 3, "0", STR_PAD_LEFT);
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos corretamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Rifa Especial</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Gerador de Rifas</h1>

    <form method="post">
        <label for="campanha">Nome da Campanha:</label>
        <input type="text" name="campanha" id="campanha" required>

        <label for="premio">Prêmio da Rifa:</label>
        <input type="text" name="premio" id="premio" required>

        <label for="valor">Valor por Bilhete (R$):</label>
        <input type="number" step="0.01" name="valor" id="valor" required>

        <label for="quantidade">Quantidade de Bilhetes:</label>
        <input type="number" name="quantidade" id="quantidade" required>

        <button type="submit" class="print-button">Gerar Bilhetes</button>
        <button onclick="window.print()" class="print-button">Imprimir Bilhetes</button>
    </form>

    <?php if ($mensagem): ?>
        <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <?php if (!empty($bilhetes)): ?>
        <h2><?= htmlspecialchars($campanha) ?></h2>
        <p style="text-align: center;"><strong>Prêmio:</strong> <?= htmlspecialchars($premio) ?> | <strong>Valor:</strong> R$ <?= number_format($valor, 2, ',', '.') ?></p>

        <div class="bilhetes">
            <?php foreach ($bilhetes as $num): ?>
                <div class="rifa">
                    <div class="canhoto">
                        <p><strong>#<?= $num ?></strong></p>
                        <p><?= htmlspecialchars($campanha) ?></p>
                        <p>Prêmio: <?= htmlspecialchars($premio) ?></p>
                        <p>R$ <?= number_format($valor, 2, ',', '.') ?></p>
                        <div class="manual">
                            <p>Nome: ________</p>
                            <p>Tel: _____</p>
                        </div>
                        <p><small><em>Canhoto</em></small></p>
                    </div>
                    <div class="cliente">
                        <p><strong>#<?= $num ?></strong></p>
                        <p><?= htmlspecialchars($campanha) ?></p>
                        <p>Prêmio: <?= htmlspecialchars($premio) ?></p>
                        <p>R$ <?= number_format($valor, 2, ',', '.') ?></p>
                        <p><small><em>Cliente</em></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</body>

</html>