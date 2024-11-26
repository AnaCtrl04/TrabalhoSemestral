<?php
include 'perguntas.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Avaliação</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="assets/regional.png" alt="logoRegional">
        </div>
        <div class="pergunta">
            <h1>
               <?php echo htmlspecialchars($pergunta['texto'], ENT_QUOTES, 'UTF-8'); ?> 
            </h1>
            <form action="salvar.php" method="post">
                <!-- Escala de cores -->
                <div class="color-scale">
                    <label>
                        <input type="radio" name="resposta" value="1" required>
                        <div class="color-box" style="background-color: #F9150F;"><p>1</p></div>
                    </label>                    
                    <label>
                        <input type="radio" name="resposta" value="2" required>
                        <div class="color-box" style="background-color: #EC441A;"><p>2</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="3" required>
                        <div class="color-box" style="background-color: #FA7B24;"><p>3</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="4" required>
                        <div class="color-box" style="background-color: #FFB129;"><p>4</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="5" required>
                        <div class="color-box" style="background-color: #FFDF28;"><p>5</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="6" required>
                        <div class="color-box" style="background-color: #D8F411;"><p>6</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="7" required>
                        <div class="color-box" style="background-color: #A7E51A;"><p>7</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="8" required>
                        <div class="color-box" style="background-color: #68D719;"><p>8</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="9" required>
                        <div class="color-box" style="background-color: #09C719;"><p>9</p></div>
                    </label>
                    <label>
                        <input type="radio" name="resposta" value="10" required>
                        <div class="color-box" style="background-color: #075027;"><p>10</p></div>
                    </label>
                </div>

                <!-- Bloco de feedback -->
                <div class="feedback">
                    <label for="feedback">Deixe seu feedback (opcional):</label>
                    <textarea id="feedback" name="feedback" rows="4" cols="50" maxlength="200" placeholder="Escreva aqui..." style="resize: none;"></textarea>
                </div>

                <!-- Botão de envio -->
                <div class="submit">
                    <button type="submit">Enviar Avaliação</button>
                </div>
            </form>
        </div>

        <footer>
            <div class="rodape">
                <p>“Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.”</p>
            </div>
        </footer>
    </div>
</body>
</html>
