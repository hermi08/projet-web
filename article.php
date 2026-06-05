<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
require("connex.php");
$idcom = connexobjet("school", "myparam");

// On vérifie que la requête marche avant de boucler
$result = $idcom->query("SELECT * FROM article ORDER BY id_article DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des articles</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff8f3;
            padding: 25px;
            color: #2c3e50;
        }
        
        .page-container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(255, 102, 0, 0.15);
            overflow: hidden;
            border: 3px solid #ff6600;
        }
        
        .page-header {
            background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
        }
        
        .page-header .btn {
            background: white;
            color: #ff6600;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        
        .page-header .btn:hover {
            background: #2c3e50;
            color: white;
            transform: translateY(-2px);
        }
        
        .table-container {
            padding: 30px;
            overflow-x: auto;
        }
        
        .table-users {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }
        
        .table-users thead {
            background: #ff6600;
            color: white;
        }
        
        .table-users th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .table-users td {
            padding: 14px 15px;
            border-bottom: 1px solid #ffe5d6;
        }
        
        .table-users tbody tr:hover {
            background: #fff5f0;
        }
        
        .table-users tbody tr:nth-child(even) {
            background: #fdfdfd;
        }
        
        .prix {
            font-weight: 700;
            color: #ff6600;
        }
        
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .badge-a { background: #e8f5e9; color: #2e7d32; }
        .badge-b { background: #fff3e0; color: #e65100; }
        
        .back-link {
            display: inline-block;
            margin: 0 30px 25px 30px;
            color: #ff6600;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }
        
        .back-link::before { content: '← '; }
    </style>
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <h1>Liste des articles</h1>
        <a href="ajouter_article.php" class="btn">+ Ajouter un article</a>
    </div>

    <div class="table-container">
        <table class="table-users">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Désignation</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // FIX: On vérifie que la requête a marché ET qu'il y a des résultats
                if($result && $result->num_rows > 0) { 
                    while($row = $result->fetch_assoc()){ 
                ?>
                <tr>
                    <td><?php echo $row['id_article']; ?></td>
                    <td><strong><?php echo $row['designation']; ?></strong></td>
                    <td class="prix"><?php echo number_format($row['prix'], 0, ',', ' '); ?> FCFA</td>
                    <td>
                        <span class="badge badge-<?php echo strtolower($row['categorie']); ?>">
                            <?php echo $row['categorie']; ?>
                        </span>
                    </td>
                </tr>
                <?php } 
                } else { ?>
                <tr>
                    <td colspan="4" style="text-align:center; padding:30px;">Aucun article enregistré</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="accueil.php" class="back-link">Retour à l'accueil</a>
</div>

</body>
</html>