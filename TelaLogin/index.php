<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="logoHospital">
            <img src="assets\regional.png" alt="logoHospital">
        </div>
        <div class="fotoHospital">
            <img src="assets/Hospital-Regional-Alto-Vale.jpg" alt="fotoHospital">
        </div>
        <div class="form">
            <form action="login.php" method="POST">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <button type="submit" class="btn-entrar">Entrar</button>
            </form>
                       
        </div>
    </div>
</body>
</html>

