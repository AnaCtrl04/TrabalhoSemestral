<?php include 'cadastrar_perguntas.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Pergunta</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Cadastro de Perguntas</h1>
    <!-- Exibe a mensagem de feedback, se houver -->
    <?php if (!is_null($mensagem)): ?>
      <p class="message"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>
    <form action="formulario_pergunta.php" method="POST">
      <label for="texto">Texto da Pergunta:</label>
      <input type="text" id="texto" name="texto" required>
      
      <label for="status">Ativo:</label>
      <input type="checkbox" id="status" name="status" checked>
      
      <button type="submit">Cadastrar</button>
    </form>
  </div>
</body>
</html>
