<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
require("connex.php");
$idcom = connexobjet("school", "myparam");

// Requête avec tes vrais noms de tables
$sql = "SELECT 
            co.id_commande as id_commande,
            cl.nom,
            cl.prenom,
            a.designation,
            cn.qte_commande as quantite,
            a.prix,
            co.date,
            (cn.qte_commande * a.prix) as total 
        FROM commande co 
        INNER JOIN client cl ON co.id_client = cl.id_client 
        INNER JOIN contenir cn ON co.id_commande = cn.id_commande 
        INNER JOIN article a ON cn.id_article = a.id_article 
        ORDER BY co.id_commande DESC";

$result = $idcom->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des ventes</title>
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
            max-width: 1200px;
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
        
        .num-comm {
            font-weight: 700;
            color: #ff6600;
            font-size: 16px;
        }
        
        .client {
            font-weight: 600;
        }
        
        .prix, .total {
            font-weight: 700;
            color: #ff6600;
        }
        
        .qte {
            background: #fff5f0;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .date {
            font-size: 13px;
            color: #666;
        }
        
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
        <h1>Liste des commandes</h1>
        <a href="vente.php" class="btn">+ Nouvelle commande</a>
    </div>

    <div class="table-container">
        <table class="table-users">
            <thead>
                <tr>
                    <th>N° Comm</th>
                    <th>Client</th>
                    <th>Article</th>
                    <th>Quantité</th>
                    <th>Prix Unit.</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result && $result->num_rows > 0) { 
                    while($row = $result->fetch_assoc()){ 
                        $date = !empty($row['date']) ? date('d/m/Y H:i', strtotime($row['date'])) : '-';
                ?>
                <tr>
                    <td class="num-comm"><?php echo $row['id_commande']; ?></td>
                    <td class="client"><?php echo $row['nom'] . ' ' . $row['prenom']; ?></td>
                    <td><strong><?php echo $row['designation']; ?></strong></td>
                    <td><span class="qte"><?php echo $row['quantite']; ?></span></td>
                    <td class="prix"><?php echo number_format($row['prix'], 0, ',', ' '); ?> FCFA</td>
                    <td class="total"><?php echo number_format($row['total'], 0, ',', ' '); ?> FCFA</td>
                    <td class="date"><?php echo $date; ?></td>
                </tr>
                <?php } 
                } else { ?>
                <tr><td colspan="7" style="text-align:center; padding:30px;">Aucune commande enregistrée</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="accueil.html" class="back-link">Retour à l'accueil</a>
</div>

</body>
</html>