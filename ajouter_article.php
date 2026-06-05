<style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background: #f8f9fa;
    padding: 30px;
    color: #333;
}

h2, h3 {
    color: #ff6b00;
    margin-bottom: 20px;
    border-left: 5px solid #ff6b00;
    padding-left: 10px;
}

h3 {
    font-size: 18px;
    margin-top: 25px;
}

/* Style du formulaire */
form {
    background: #fff;
    max-width: 600px;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(255, 107, 0, 0.15);
    border: 1px solid #ffe0cc;
}

/* Labels + inputs */
input[type="text"],
input[type="number"],
input[type="email"],
select {
    width: 100%;
    padding: 12px 15px;
    margin: 8px 0 20px 0;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
select:focus {
    outline: none;
    border-color: #ff6b00;
    box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
}

input[readonly] {
    background: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
}

/* Boutons */
button, input[type="submit"] {
    background: #ff6b00;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 10px;
}

button:hover, input[type="submit"]:hover {
    background: #e55a00;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 0, 0.3);
}

button[type="button"] {
    background: #fff;
    color: #ff6b00;
    border: 2px solid #ff6b00;
}

button[type="button"]:hover {
    background: #fff5f0;
}

/* Liens */
a {
    text-decoration: none;
}

/* Tableau list_vent.php */
table {
    width: 100%;
    background: #fff;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-top: 20px;
}

th {
    background: #ff6b00;
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

td {
    padding: 12px 15px;
    border-bottom: 1px solid #f1f3f5;
}

tr:hover {
    background: #fff5f0;
}

tr:last-child td {
    border-bottom: none;
}
</style>

<?php
require("connex.php");
$idcom = connexobjet("school", "myparam");

if(isset($_POST['valider'])){
    
    $aarticle = $_POST['aarticle'];
    $designation = $_POST['Designation'];
    $prix = $_POST['Prix'];
    $categorie = $_POST['categorie'];
    
    $requete = "INSERT INTO article (aarticle, Designation, Prix, categorie) 
                VALUES ('$aarticle', '$designation', $prix, '$categorie')";
    
    if($idcom->query($requete)){
        header("Location: article.php"); // Redirige vers le tableau après ajout
        exit();
    } else {
        echo "Erreur : " . $idcom->error . "<br>";
    }
}
?>

<h3>Ajouter un article</h3>
<form method="post">
    Article: <input type="text" name="aarticle" required><br><br>
    Désignation: <input type="text" name="Designation" required><br><br>
    Prix: <input type="number" step="0.01" name="Prix" required><br><br>
    Catégorie: <input type="text" name="categorie" required><br><br>
    <input type="submit" name="valider" value="Ajouter">
</form>
<br>
<a href="article.php">Retour à la liste</a>