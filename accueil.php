<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <style>
        */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
    padding: 20px;
    color: #2c3e50;
}

.plateforme-container {
    max-width: 950px;
    margin: 0 auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 2px solid #ff6600;
}

/* En-tête avec logos */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 25px;
    background: white;
    border-bottom: 4px solid #ff6600;
}

.header .logo-box {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header .logo-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.header .title {
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ff6600;
    letter-spacing: 1.5px;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* Corps avec les liens */
.menu-body {
    padding: 35px 50px;
    background: white;
}

.menu-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.menu-list li {
    background: white;
    border: 2px solid #f0f0f0;
    border-left: 5px solid #ff6600;
    border-radius: 6px;
    transition: 0.3s ease;
}

.menu-list li:hover {
    background: #fff5f0;
    border-color: #ff6600;
    transform: translateX(8px);
    box-shadow: 0 3px 10px rgba(255, 102, 0, 0.2);
}

.menu-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 22px;
    text-decoration: none;
    color: #2c3e50;
    font-weight: 500;
    font-size: 16px;
}

.menu-list a::after {
    content: '➜';
    font-size: 18px;
    color: #ff6600;
    font-weight: bold;
    transition: 0.3s;
}

.menu-list li:hover a::after {
    transform: translateX(5px);
}

.menu-list .page-name {
    color: #ff6600;
    font-size: 13px;
    font-weight: 600;
    background: #fff5f0;
    padding: 3px 8px;
    border-radius: 4px;
}

/* Footer */
.footer {
    text-align: center;
    padding: 12px;
    background: #ff6600;
    color: white;
    font-size: 13px;
    font-weight: 500;
}

/* Barre user en haut */
.user-bar {
    max-width: 950px;
    margin: 0 auto 15px auto;
    background: #2c3e50;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.user-bar .logout-btn {
    background: #ff6600;
    color: white;
    padding: 6px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.user-bar .logout-btn:hover {
    background: #e55a00;
}

    </style>
        
     
</head>
<body>

<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
?>
<link rel="stylesheet" href="style.css">

<div class="user-bar">
    Connecté : <strong><?php echo $_SESSION['user']; ?></strong>
    <a href="deconnexion.php">Déconnexion</a>
</div>

<div class="plateforme-container">
    <div class="header">
        <div class="logo">UAC<br>UAC</div>
        <div class="title">BIENVENUE DANS MA PLATEFORME</div>
        <div class="logo">ENEAM<br>ENEAM</div>
    </div>

    <div class="menu-body">
        <ul class="menu-list">
            <li>
                <a href="utilisateur.php">
                    Liste utilisateur
                    <span class="page-name">listuser.php</span>
                </a>
            </li>
            <li>
                <a href="article.php">
                    Liste article
                    <span class="page-name">Voirarticle.php</span>
                </a>
            </li>
            <li>
                <a href="client.php">
                    Liste client
                    <span class="page-name">client.php</span>
                </a>
            </li>
            <li>
                <a href="list_vent.php">
                    Liste vente
                    <span class="page-name">list_vent.php</span>
                </a>
            </li>
            <li>
                <a href="vente.php">
                    Effectuer vente
                    <span class="page-name">effectuer_vente.php</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="footer">
        accueil.php - Plateforme UAC/ENEAM
    </div>
</div>
</body>
</html>