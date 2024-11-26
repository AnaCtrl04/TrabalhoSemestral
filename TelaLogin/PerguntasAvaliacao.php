<?php include 'cadastrar_perguntas.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Perguntas</title>
    <link rel="stylesheet" href="PerguntasAvaliacao.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Perguntas</h1>
        <!-- Exibe a mensagem de feedback -->
        <?php if ($mensagem): ?>
            <div class="message <?php echo $error ? 'error' : ''; ?>">
                <?php echo htmlspecialchars($mensagem); ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de cadastro -->
        <form action="PerguntasAvaliacao.php" method="POST">
            <label for="texto">Texto da Pergunta:</label>
            <input type="text" id="texto" name="texto" placeholder="Digite sua pergunta..." maxlength="255" required>
            
            <label for="status">Ativo:</label>
            <input type="checkbox" id="status" name="status" checked>
            
            <button type="submit">Cadastrar</button>
        </form>

        <!-- Lista de perguntas com rolagem -->
        <h2>Perguntas Cadastradas</h2>
        <div class="table-container">
            <?php $perguntas = listarPerguntas($pdo); ?>
            <?php if (!empty($perguntas)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Texto</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perguntas as $pergunta): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pergunta['id']); ?></td>
                                <td><?php echo htmlspecialchars($pergunta['texto']); ?></td>
                                <td><?php echo $pergunta['status'] ? 'Ativo' : 'Inativo'; ?></td>
                                <td>
                                    <form action="PerguntasAvaliacao.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="delete_id" value="<?php echo $pergunta['id']; ?>">
                                        <button type="submit" class="delete-btn">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhuma pergunta cadastrada.</p>
            <?php endif; ?>
        </div>

        <!-- Botão voltar -->
        <div class="actions">
            <a href="tela_inicial.html" class="back-btn">Voltar</a>
        </div>
    </div>
</body>
</html>
