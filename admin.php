<?php
$conn = new mysqli('localhost','root','root','xbox_survey');

$results = $conn->query("
    SELECT u.pseudo, q.texte_question, r.reponse FROM reponses r
    JOIN utilisateurs u ON r.id_utilisateur = u.id
    JOIN questions q ON r.id_question = q.id
    ORDER BY u.pseudo
");

$data = [];

while($row = $results->fetch_assoc()){
$data[$row['pseudo']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin - Résultats</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0b0c2c;
display:flex;
justify-content:center;
padding-top:40px;
position:relative;
}

/* paillettes */

body::before{
content:"";
position:fixed;
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

.container{
width:650px;
}

h1{
text-align:center;
color:#00bfff;
margin-bottom:30px;
}

/* card utilisateur */

.card{
background:#1a1a4d;
border-radius:20px;
margin-bottom:15px;
box-shadow:0 15px 30px rgba(0,0,0,0.5);
overflow:hidden;
}

.user{
padding:15px;
cursor:pointer;
font-weight:bold;
color:#00bfff;
}

.answers{
display:none;
padding:15px;
color:white;
border-top:1px solid rgba(255,255,255,0.1);
}

.answers p{
margin:10px 0;
}

</style>

<script>
   function toggle(id){
     let element = document.getElementById(id);
        if(element.style.display === "block"){
            element.style.display = "none";
        }else{
            element.style.display = "block";
        }

}

</script>

</head>

<body>
    <div class="container">
    <h1>Résultats de l’enquête</h1>

<?php
    $i=0;
    foreach($data as $pseudo => $reponses):
    $i++;
?>

    <div class="card">
    <div class="user" onclick="toggle('user<?= $i ?>')">
    <?= htmlspecialchars($pseudo) ?>
    </div>

<div class="answers" id="user<?= $i ?>">

    <?php foreach($reponses as $rep): ?>

<p>
    <strong><?= htmlspecialchars($rep['texte_question']) ?></strong><br>
    <?= htmlspecialchars($rep['reponse']) ?>
</p>

<?php endforeach; ?>

</div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>