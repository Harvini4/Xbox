<?php
$conn = new mysqli('localhost', 'root', 'root', 'xbox_survey');

if(isset($_POST['submit'])){
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utilisateurs (pseudo,email,mdp) VALUES (?,?,?)");
    $stmt->bind_param("sss", $pseudo, $email, $mdp);

    if($stmt->execute()){
        $message = "Inscription réussie. <a href='connexion.php'>Se connecter</a>";
    } else {
        $message = "Erreur : " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription Xbox</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #0b0c2c;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative;
    overflow: hidden;
}
body::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    background-image: radial-gradient(white 1px, transparent 1px);
    background-size: 10px 10px;
    animation: moveStars 30s linear infinite;
    opacity: 0.2;
}
@keyframes moveStars {
    0% { transform: translate(0,0); }
    100% { transform: translate(-50%, -50%); }
}
.card {
    position: relative;
    background: #1a1a4d;
    padding: 30px 40px;
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.5);
    width: 450px;
    z-index: 1;
    color: #ffffff;
}
.card h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #00bfff;
}
.card form input[type="text"],
.card form input[type="email"],
.card form input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0 16px 0;
    border: 1px solid #00bfff;
    border-radius: 10px;
    background-color: #0b0c2c;
    color: #ffffff;
    box-sizing: border-box;
}
.card form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #00bfff;
    color: #0b0c2c;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s;
}
.card form input[type="submit"]:hover {
    background-color: #0091cc;
}
.card p { margin: 8px 0; }
</style>
</head>
<body>
<div class="card">
    <h1>Inscription Xbox</h1>
    <?php if(isset($message)) echo "<p>$message</p>"; ?>
    <form method="POST">
        Pseudo: <input type="text" name="pseudo" required><br>
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="mdp" required><br>
        <input type="submit" name="submit" value="S’inscrire">
    </form>
</div>
</body>
</html>