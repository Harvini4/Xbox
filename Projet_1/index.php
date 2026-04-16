<?php
session_start();

$conn = new mysqli('localhost','root','root','xbox_survey');

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $stmt = $conn->prepare("SELECT id, mdp FROM utilisateurs WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$hash);
    if($stmt->fetch()){
        if(password_verify($mdp,$hash)){
            $_SESSION['id'] = $id;
                header("Location: enquete.php");
                exit;
        }else{
            $message = "Mot de passe incorrect";

}
    }else{
    $message = "Utilisateur introuvable";

}

}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Connexion Xbox</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0b0c2c;
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
position:relative;
overflow:auto;
}

body::before{
content:"";
position:absolute;
width:200%;
height:200%;
background-image:radial-gradient(white 1px, transparent 1px);
background-size:10px 10px;
animation:stars 30s linear infinite;
opacity:0.2;
pointer-events:none;
}

@keyframes stars{
0%{transform:translate(0,0);}
100%{transform:translate(-50%,-50%);}
}

.card{
background:#1a1a4d;
padding:40px;
border-radius:20px;
width:400px;
color:white;
box-shadow:0 15px 30px rgba(0,0,0,0.5);
}

h1{
text-align:center;
color:#00bfff;
margin-bottom:25px;
}

input[type=email],
input[type=password]{

width:100%;
padding:12px;
border-radius:8px;
border:1px solid #00bfff;
background:#0b0c2c;
color:white;
margin-bottom:15px;
}

button{

width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#00bfff;
color:black;
font-size:16px;
cursor:pointer;
margin-top:10px;

}

button:hover{
background:#0091cc;
}

.inscription{

margin-top:15px;
text-align:center;

}

.inscription a{

color:#00bfff;
text-decoration:none;
font-weight:bold;

}

</style>

</head>

<body>
    <div class="card">
    <h1>Connexion</h1>

<?php
if(isset($message)){
echo "<p>$message</p>";
}
?>

    <form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mdp" placeholder="Mot de passe" required>
    <button type="submit" name="submit">Se connecter</button>
    </form>

<div class="inscription">

<p>Pas de compte ?</p>

<a href="inscription.php">S'inscrire</a>

</div>

</div>

</body>

</html>