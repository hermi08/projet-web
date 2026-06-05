<style>
    */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #fff8f3;
    padding: 25px;
    color: #2c3e50;
}

.form-container {
    max-width: 650px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 25px rgba(255, 102, 0, 0.15);
    overflow: hidden;
    border: 3px solid #ff6600;
}

.form-header {
    background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%);
    color: white;
    padding: 25px 30px;
    text-align: center;
}

.form-header h1 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-body {
    padding: 35px 40px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: inline-block;
    width: 140px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 15px;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="number"] {
    width: 280px;
    padding: 10px 14px;
    border: 2px solid #ffe5d6;
    border-radius: 8px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: 0.3s;
}

.form-group input:focus {
    outline: none;
    border-color: #ff6600;
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.1);
}

.input-inline {
    display: flex;
    align-items: center;
    gap: 10px;
}

.input-inline input {
    flex: 1;
}

.btn-submit {
    background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%);
    color: white;
    padding: 13px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: 0.3s;
    margin-top: 15px;
    margin-left: 140px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 102, 0, 0.4);
}

.btn-search {
    background: white;
    color: #ff6600;
    border: 2px solid #ff6600;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    font-size: 14px;
}

.btn-search:hover {
    background: #ff6600;
    color: white;
}

.form-footer {
    padding: 20px 40px;
    background: #fff8f3;
    border-top: 2px solid #ffe5d6;
}

.back-link {
    color: #ff6600;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
}

.back-link::before {
    content: '← ';
}
</style>

<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
?>
<link rel="stylesheet" href="style.css">

<div class="form-container">
    <div class="form-header">
        <h1>Nouvelle Vente</h1>
    </div>

    <form method="POST" action="traitement_vente.php" class="form-body">
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="nom" required>
        </div>

        <div class="form-group">
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
        </div>

        <div class="form-group">
            <label>Age :</label>
            <input type="number" name="age" required>
        </div>

        <div class="form-group">
            <label>Adresse :</label>
            <input type="text" name="adresse" required>
        </div>

        <div class="form-group">
            <label>Ville :</label>
            <input type="text" name="ville" value="Calavi">
        </div>

        <div class="form-group">
            <label>Mail :</label>
            <input type="email" name="mail" required>
        </div>

        <div class="form-group">
            <label>Article choisi :</label>
            <div class="input-inline">
                <input type="hidden" name="id_article" id="id_article" required>
                <input type="text" id="designation" readonly placeholder="Sélectionnez un article">
                <button type="button" class="btn-search" onclick="chercherArticle()">Rechercher article</button>
            </div>
        </div>

        <div class="form-group">
            <label>Quantité :</label>
            <input type="number" name="quantite" value="1" min="1" required>
        </div>

        <button type="submit" class="btn-submit">Enregistrer commande</button>
    </form>

    <div class="form-footer">
        <a href="accueil.php" class="back-link">Retour à l'accueil</a>
    </div>
</div>

<script>
function chercherArticle() {
    window.open('choix.php', 'popup', 'width=700,height=500');
}
</script>