<style>
    */
.vente-card {
    background: white;
    border: 2px solid #ffe5d6;
    border-radius: 10px;
    margin-bottom: 25px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(255, 102, 0, 0.1);
}

.vente-header {
    background: #ff6600;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.vente-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
}

.vente-date {
    font-size: 13px;
    background: rgba(255,255,255,0.2);
    padding: 4px 10px;
    border-radius: 15px;
}

.vente-body {
    padding: 0;
}

.table-vente {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.table-vente thead {
    background: #2c3e50;
    color: white;
}

.table-vente th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
}

.table-vente td {
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
}

.table-vente .total-row {
    background: #fff5f0;
    font-weight: 700;
    color: #ff6600;
}

.table-vente .total-row td {
    border-bottom: none;
    font-size: 15px;
}

.grand-total {
    background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%);
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    border-radius: 8px;
    margin-top: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

</style>


<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
require("connex.php");
$idcom = connexobjet("school", "myparam");
?>
<link rel="stylesheet" href="style.css">

<div class="page-container">
    <div class="page-header">
        <h1>Historique des ventes</h1>
        <a href="nouvelle_vente.php" class="btn">+ Nouvelle vente</a>
    </div>

    <div class="table-container">
        <?php
        $total_general = 0;
        $ventes = $idcom->query("SELECT * FROM commande ORDER BY id_commande DESC");
        
        while($vente = $ventes->fetch_assoc()){
            $id_vente = $vente['id_commande'];
            $date_vente = $vente['date'] ? date('d/m/Y H:i', strtotime($vente['date'])) : 'Date inconnue';
            $client = $vente['nom']; // adapte selon ta colonne
            
            $details = $idcom->query("SELECT * FROM commande dv 
                                     JOIN article a ON commande.id_article = a.ID 
                                     WHERE commande.id_commande = $id_vente");
            $total_commande = 0;
        ?>
        
        <div class="vente-card">
            <div class="vente-header">
                <h3>Commande N°<?php echo $id_vente; ?> - <?php echo $client; ?></h3>
                <span class="vente-date"><?php echo $date_vente; ?></span>
            </div>
            
            <div class="vente-body">
                <table class="table-vente">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($detail = $details->fetch_assoc()){ 
                            $sous_total = $detail['prix'] * $detail['quantite'];
                            $total_commande += $sous_total;
                        ?>
                        <tr>
                            <td><?php echo $detail['designation']; ?></td>
                            <td><?php echo number_format($detail['prix'], 0, ',', ' '); ?> FCFA</td>
                            <td><?php echo $detail['quantite']; ?></td>
                            <td class="prix"><?php echo number_format($sous_total, 0, ',', ' '); ?> FCFA</td>
                        </tr>
                        <?php } ?>
                        <tr class="total-row">
                            <td colspan="3"><strong>TOTAL COMMANDE</strong></td>
                            <td><strong><?php echo number_format($total_commande, 0, ',', ' '); ?> FCFA</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php 
            $total_general += $total_commande;
        } 
        ?>
        
        <div class="grand-total">
            TOTAL GÉNÉRAL DE TOUTES LES VENTES : <?php echo number_format($total_general, 0, ',', ' '); ?> FCFA
        </div>
    </div>

    <a href="accueil.php" class="back-link">Retour à l'accueil</a>
</div>