
<?php 
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css" />
    <link href="logo.png" rel="icon" />
    <title>Login</title>
</head>
<body>
    
<div class="container">
    <h2>Connexion</h2>
    <form action="connexion.php" method="post">
        <div class="form-group">
            <label for="username">Mail :</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Se connecter">
    </form>
</div>  

</body>
</html>