<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
require("connex.php");
$idcom = connexobjet("connexion", "myparam");

// 1. On bloque si on arrive ici sans POST
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: vente.php");
    exit();
}

// 2. On récupère les données SANS warnings avec ?? 
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$age = intval($_POST['age'] ?? 0);
$adresse = trim($_POST['adresse'] ?? '');
$ville = trim($_POST['ville'] ?? '');
$mail = trim($_POST['mail'] ?? '');
$id_article = intval($_POST['id_article'] ?? 0);
$quantite = intval($_POST['quantite'] ?? 0);

// 3. On vérifie que rien n'est vide
if(empty($nom) || empty($prenom) || empty($adresse) || empty($mail) || $id_article <= 0 || $quantite <= 0){
    die("Erreur : Tous les champs sont obligatoires. <a href='vente.php'>Retour au formulaire</a>");
}

try {
    // 4. On insère le client avec requête préparée = pas d'erreur SQL
    $stmt = $idcom->prepare("INSERT INTO client (nom, prenom, age, adresse, ville, mail) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nom, $prenom, $age, $adresse, $ville, $mail);
    $stmt->execute();
    $id_client = $idcom->insert_id;
    $stmt->close();
    
    // 5. On crée la vente
    $stmt = $idcom->prepare("INSERT INTO vente (id_client, date_vente) VALUES (?, NOW())");
    $stmt->bind_param("i", $id_client);
    $stmt->execute();
    $id_vente = $idcom->insert_id;
    $stmt->close();
    
    // 6. On ajoute le détail vente
    $stmt = $idcom->prepare("INSERT INTO detail_vente (id_vente, id_article, quantite) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id_vente, $id_article, $quantite);
    $stmt->execute();
    $stmt->close();
    
    // 7. Succès avec style blanc/orange
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8">';
    echo '<style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");
        body{font-family:"Poppins",sans-serif; background:#fff8f3; padding:40px; text-align:center;}
        .success{max-width:600px; margin:0 auto; background:white; border:3px solid #ff6600; 
                 border-radius:12px; padding:40px; box-shadow:0 4px 25px rgba(255,102,0,0.15);}
        h1{color:#ff6600; font-size:28px; margin-bottom:15px;}
        p{font-size:16px; color:#2c3e50; margin-bottom:25px;}
        .btn{background:linear-gradient(90deg,#ff6600 0%,#ff8533 100%); color:white; 
             padding:12px 25px; border-radius:8px; text-decoration:none; font-weight:700; 
             display:inline-block; margin:5px;}
    </style></head><body>';
    echo '<div class="success">';
    echo "<h1>✓ Vente enregistrée !</h1>";
    echo "<p>Commande N°$id_vente pour $prenom $nom créée avec succès</p>";
    echo '<a href="effectuer_vente.php" class="btn">Voir les ventes</a>';
    echo '<a href="vente.php" class="btn">Nouvelle vente</a>';
    echo '</div></body></html>';

} catch (mysqli_sql_exception $e) {
    die("Erreur SQL : " . $e->getMessage() . " <br><a href='vente.php'>Retour</a>");
}
?>