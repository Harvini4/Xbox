<?php
session_start();

$conn = new mysqli('localhost','root','root','xbox_survey');

if(!isset($_SESSION['id'])){
    header("Location: connexion.php");
    exit;
}

$questions = $conn->query("SELECT * FROM questions");

if(isset($_POST['submit'])){
    $id_user = $_SESSION['id'];
    foreach($_POST['reponse'] as $id_question => $rep){
        if(is_array($rep)){
        $rep = implode(", ", $rep);
        }
    $stmt = $conn->prepare("INSERT INTO reponses (id_utilisateur,id_question,reponse) VALUES (?,?,?)");
    $stmt->bind_param("iis",$id_user,$id_question,$rep);
    $stmt->execute();
}

$message="Merci pour vos réponses !";

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Enquête Xbox</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0b0c2c;
display:flex;
justify-content:center;
align-items:flex-start;
min-height:100vh;
padding-top:40px;
overflow:auto;
position:relative;
}

/* paillettes */
body::before{
content:"";
position:fixed;
top:0;
left:0;
width:200%;
height:200%;
background-image:radial-gradient(white 1px, transparent 1px);
background-size:10px 10px;
animation:stars 30s linear infinite;
opacity:0.2;
pointer-events:none;
z-index:0;
}

@keyframes stars{
0%{transform:translate(0,0);}
100%{transform:translate(-50%,-50%);}
}

.card{
position:relative;
z-index:1;
background:#1a1a4d;
padding:30px;
border-radius:20px;
width:550px;
color:white;
box-shadow:0 15px 30px rgba(0,0,0,0.5);
}

h1{
text-align:center;
color:#00bfff;
margin-bottom:20px;
}

p{
margin-top:20px;
}

input[type="radio"],
input[type="checkbox"]{
margin-right:10px;
cursor:pointer;
}

input[type="text"]{
width:100%;
padding:10px;
border-radius:8px;
border:1px solid #00bfff;
background:#0b0c2c;
color:white;
margin-top:10px;
}

button{
width:100%;
padding:12px;
margin-top:20px;
border:none;
border-radius:10px;
background:#00bfff;
cursor:pointer;
font-size:16px;
}

button:hover{
background:#0091cc;
}

</style>

</head>

<body>
    <div class="card">
    <h1>Enquête Xbox</h1>

<?php if(isset($message)) echo 
    "<p>$message</p>"; ?>

<form method="POST">

<?php while($q = $questions->fetch_assoc()): ?>

<p><strong><?= $q['texte_question'] ?></strong></p>

<?php

$options = explode(",", $q['options']);

if($q['type_question']=="radio"){
    foreach($options as $opt){
    echo "<label><input type='radio' name='reponse[".$q['id']."]' value='$opt'> $opt</label><br>";
}

    }elseif($q['type_question']=="checkbox"){
    foreach($options as $opt){
    echo "<label><input type='checkbox' name='reponse[".$q['id']."][]' value='$opt'> $opt</label><br>";
}

    }else{
    echo "<input type='text' name='reponse[".$q['id']."]'>";

}

?>

<?php endwhile; ?>

<button type="submit" name="submit">Envoyer</button>

</form>

</div>

</body>
</html>